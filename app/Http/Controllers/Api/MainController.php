<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Http\Requests\Api\PageRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\DesignsResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\SliderResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Complain;
use App\Models\Governorate;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Page;
use App\Models\UserDesign;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Site\SoreOrderRequest;
use App\Http\Requests\Site\StoreComplainRequest;
use App\Jobs\IncreasProductSalesCountJob;
use App\Jobs\IncreasProductViewsCountJob;

use App\Models\Slide;
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
        $products = Product::inRandomOrder()->take(9)->get();
        $users = User::inRandomOrder()->take(3)->get();
        $designs = UserDesign::inRandomOrder()->take(6)->get();
        $data = [
            'slides' => SliderResource::collection($slides),
            'products' => ProductsResource::collection($products),
            'designers' => AuthResource::collection($users),
            'designs' => DesignsResource::collection($designs),
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

        return self::makeSuccess(Response::HTTP_OK, '', ProductsResource::collection($products));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function products(): JsonResponse
    {
        $products = Product::with(['variations.color'])->latest()->paginate(15);
        return self::makeSuccess(Response::HTTP_OK, '', ProductsResource::collection($products));
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
        return self::makeSuccess(Response::HTTP_OK, '', ProductsResource::make($product));
    }

    /**
     * @return JsonResponse
     */
    public function explore(): JsonResponse
    {
        $products = Product::with(['variations.color', 'variations.size'])->latest()->take(15)->get();
        $users = User::latest()->where('type', User::USER)->take(15)->get();
        $data = [
            'products' => ProductsResource::collection($products),
            'designers' => AuthResource::collection($users),
        ];
        return self::makeSuccess(Response::HTTP_OK, '', $data);
    }

    /**
     * @return JsonResponse
     */
    public function designs(): JsonResponse
    {
        $records = UserDesign::latest()->get();
        return self::makeSuccess(Response::HTTP_OK, '', DesignsResource::collection($records));
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
        $cart = Cart::where('user_id', Auth::id())->get()->toArray();
        return self::makeSuccess(Response::HTTP_OK, '', $cart);
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
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
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
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
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

    public function pages(PageRequest $request): JsonResponse
    {
        $page = Page::where('slug', $request->slug)->first();
        return self::makeSuccess(Response::HTTP_OK, '', $page);
    }
}
