<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\Payment\SurePayController;
use App\Http\Requests\Site\CartRequest;
use App\Models\Cart;
use App\Models\City;
use App\Models\Design;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Http\Requests\Site\RegisterRequest;
use App\Http\Requests\Site\SoreOrderRequest;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\StoreComplainRequest;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Jobs\IncreasProductSalesCountJob;
use App\Jobs\IncreasProductViewsCountJob;

use App\Models\Slide;
use App\Models\Page;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('site.checkout');
    }

    public function store(SoreOrderRequest $request)
    {
        $sub_total = 0;
        $discount = 0;
        $items = Cart::where('user_id', auth()->id())->get();
        if (count($items) <= 0) {
            return redirect(route('cart.index'))->with('error', __('messages.not_found_records'));
        }
        foreach ($items as $item) {
            $sub_total += ($item->quantity * $item->price);
        }
        // calculate the shipping cost
        $address = UserAddress::find($request->address_id);
        $city = $address->city;
        $governorate = $address->governorate;
        $shipping_cost = $governorate->shipping_cost ?? 0;
        $total = $sub_total * 1.15 + $shipping_cost - $discount;
        $vat = $sub_total * 0.15;
        $order = Order::create([
            'number' => time() . mt_rand(1, 1000) . auth()->id(),
            'user_id' => auth()->id(),
            'subtotal' => $sub_total,
            'shipping_cost' => $shipping_cost,
            'total' => $total,
            'discount' => $discount,
            'vat' => $vat,
            'coupon_id' => $request->coupon_id,
            'governorate_id' => $address->governorate_id,
            'city_id' => $address->city_id,
            'address' => $address->building_number . ' - ' . $address->street_name . ' - ' . $address->district,
            'shipping_statues_id' => 1,
            'payment_method_id' => $request->payment_method_id,
            'order_phone' => auth()->user()->phone,
            'client_name' => auth()->user()->name,
        ]);

        $itemsPayment = [];
        foreach ($items as $item) {
            $itemsPayment[] = [
                'name' => $item->variation->product->name ?? 'product',
                'price' => $item->price,
                'quantity' => $item->quantity,
            ];
            $order_item = [
                'variation_id' => $item->variation_id,
                'design_id' => $item->design_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'design_front_image' => $item->design_front_image ?? null,
                'design_back_image' => $item->design_back_image ?? null,
                'details' => $item->details ?? null,
                'details_back' => $item->details_back ?? null,
            ];
            $order->items()->create($order_item);
            dispatch(new IncreasProductSalesCountJob($item->variation_id));
        }
        Cart::where('user_id', auth()->id())->delete();
        // payment
        if ($request->payment_method_id == 2) { // bank
            if ($shipping_cost) {
                $itemsPayment[] = [
                    'name' => __('site.shipping_price'),
                    'price' => $shipping_cost,
                    'quantity' => 1,
                ];
            }
            if ($vat) {
                $itemsPayment[] = [
                    'name' => __('site.vat'),
                    'price' => $vat,
                    'quantity' => 1,
                ];
            }
            $data = [
                'customer_name' => $order->client_name,
                'customer_email' => $order->user->email,
                'customer_mobile' => $order->order_phone,
                'reference_id' => $order->number,
                'items' => $itemsPayment,
            ];

            $response = new SurePayController();
            $result = $response->pay($data);
            if (isset($result->pay_url)) {
                return redirect($result->pay_url);
            }
        }

        return view('site.success')->with('success', __('messages.created_successfully'));
    }

    public function pay($order_id)
    {
        $order = Order::whereNumber($order_id)->firstOrFail();
        $itemsPayment = [];
        foreach ($order->items as $item) {
            $itemsPayment[] = [
                'name' => $item->variation->product->name ?? 'product',
                'price' => $item->price,
                'quantity' => $item->quantity,
            ];
        }
        if ($order->shipping_cost) {
            $itemsPayment[] = [
                'name' => __('site.shipping_price'),
                'price' => $order->shipping_cost,
                'quantity' => 1,
            ];
        }
        if ($order->vat) {
            $itemsPayment[] = [
                'name' => __('site.vat'),
                'price' => $order->vat,
                'quantity' => 1,
            ];
        }
        $data = [
            'customer_name' => $order->client_name,
            'customer_email' => $order->user->email,
            'customer_mobile' => $order->order_phone,
            'reference_id' => $order->number,
            'items' => $itemsPayment,
        ];

        $response = new SurePayController();
        $result = $response->pay($data);
        if (isset($result->pay_url)) {
            return redirect($result->pay_url);
        }
        return view('site.success')->with('success', __('messages.created_successfully'));
    }
}
