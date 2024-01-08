<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
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
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $slides = Slide::where('is_active', 1)->latest()->get();
        $recommend_users = User::where('type', 1)->inRandomOrder()->take(8)->get();
        $products = Product::inRandomOrder()->take(9)->get();
        $users = User::inRandomOrder()->take(3)->get();
        $data = [
            'slides' => $slides,
            'recommend_users' => $recommend_users,
            'products' => $products,
            'users' => $users,
        ];
        return self::makeSuccess(Response::HTTP_OK, '', $data);
    }

    public function search(Request $request): JsonResponse
    {
        $search = $request->search;
        $products = Product::with(['variations', 'variations.color'])->where(function ($query) use ($search) {
            $query
                ->where('name->ar', 'LIKE', '%' . $search . '%')
                ->orWhere('name->en', 'LIKE', '%' . $search . '%')
                ->orWhere('description->en', 'LIKE', '%' . $search . '%')
                ->orWhere('description->en', 'LIKE', '%' . $search . '%');
        })->paginate(30);

        return self::makeSuccess(Response::HTTP_OK, '', $products);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function product(Product $product): JsonResponse
    {
        dispatch(new IncreasProductViewsCountJob($product));
        $product->load(['images']);
        $products = Product::with(['variations.color'])->inRandomOrder()->limit(9)->get();
        return self::makeSuccess(Response::HTTP_OK, '', $products);
    }

    /**
     * @return JsonResponse
     */
    public function explore(): JsonResponse
    {
        $products = Product::with(['variations.color'])->latest()->take(15)->get();
        $users = User::latest()->take(15)->get();
        $data = [
            'products' => $products,
            'users' => $users,
        ];
        return self::makeSuccess(Response::HTTP_OK, '', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function products(): JsonResponse
    {
        $products = Product::with(['variations.color'])->latest()->paginate(20);
        return self::makeSuccess(Response::HTTP_OK, '', $products, false);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function category_products(Category $category): JsonResponse
    {
        $products = Product::where('active', 1)->where('category_id', $category->id)->latest()->paginate(20);
        return self::makeSuccess(Response::HTTP_OK, '', $products, false);
    }


    public function cart()
    {
        return view('site.cart');
    }

    public function checkout()
    {
        return view('site.checkout');
    }


    public function save_order(SoreOrderRequest $request)
    {
        $sub_total = 0;
        $total = 0;
        $items = Cart::where('user_id', Auth::id())->get();
        foreach ($items as $item) {
            $sub_total += ($item->quantity * $item->price);
        }
        // calculate the shipping cost
        $city = City::find($request->city);
        $governorate = Governorate::find($request->governorate_id);
        $shipping_cost = $city->shipping_cost ? $city->shipping_cost : $governorate->shipping_cost;

        $order = new Order;
        $order->number = time() . mt_rand(1, 1000) . Auth::id();
        $order->total = $total;
        $order->user_id = Auth::id();
        $order->subtotal = $sub_total;
        $order->shipping_cost = $shipping_cost;
        $order->total = $shipping_cost + $sub_total;
        $order->discount = 0;
        $order->governorate_id = $request->governorate_id;
        $order->city_id = $request->city;
        $order->address = $request->address;
        $order->shipping_statues_id = 1;
        $order->order_phone = $request->phone;
        $order->client_name = $request->client_name;
        $order->save();

        foreach ($items as $item) {
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->variation_id = $item->variation_id;
            $order_item->price = $item->price;
            $order_item->quantity = $item->quantity;
            $order_item->save();
            dispatch(new IncreasProductSalesCountJob($item->variation_id));
        }
        Cart::where('user_id', Auth::id())->delete();
        return view('site.success')->with('success', 'تم انشاء الطلب بنجاح');
    }

    public function complains()
    {
        return view('site.complains');
    }

    public function store_complains(StoreComplainRequest $request)
    {
        $complain = new Complain;
        $complain->user_id = Auth::id();
        $complain->content = $request->input('content');
        $complain->phone = $request->phone;
        $complain->email = $request->email;
        $complain->category = $request->category;
        $complain->type = $request->type;
        $complain->save();
        toastr()->success('تم الارسال بنجاح');
        return redirect()->back();
    }

    public function downloadProductImages(Product $product)
    {
        $zip_file = Zip::create($product->name . '-images.zip');
        $zip_file->add("s3://alaa-eldeen-s3-bucket/products/" . $product->image, $product->image);
        foreach ($product->images as $product_image) {
            $zip_file->add("s3://alaa-eldeen-s3-bucket/products/" . $product_image->image, $product_image->image);
        }
        return $zip_file;
    }

    public function phone()
    {
        return view('site.phone');
    }

    public function update_phone(Request $request)
    {
        $user = Auth::user();
        $user->phone = $request->phone;
        $user->save();
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        return redirect(route('site.verify_phone'));
    }


}
