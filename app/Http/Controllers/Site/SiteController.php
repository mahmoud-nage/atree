<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Design;
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

class SiteController extends Controller
{


    public function index()
    {
        $slides = Slide::where('is_active', 1)->latest()->get();
        $recomanded_users = User::where('type', User::USER)->orderByRaw("RAND()")->take(8)->get();
        $products = Product::inRandomOrder()->take(9)->get();
        $designs = Design::inRandomOrder()->take(6)->get();
        return view('site.index', compact('slides', 'recomanded_users', 'products', 'designs'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page(Page $page)
    {
        return view('site.page', compact('page'));
    }

    public function user(User $user)
    {
        $user = auth()->user();
        $user->load('designs')->loadCount('followers');
        $latest_designs = Design::where('user_id', auth()->id())->latest()->get()->take(4);
        return view('site.bio', compact('user','latest_designs'));
    }


    public function contact()
    {
        return view('site.contact');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $products = Product::with(['variations', 'variations.color'])->where(function ($query) use ($search) {
            $query
                ->where('name->ar', 'LIKE', '%' . $search . '%')
                ->orWhere('name->en', 'LIKE', '%' . $search . '%')
                ->orWhere('description->en', 'LIKE', '%' . $search . '%')
                ->orWhere('description->en', 'LIKE', '%' . $search . '%');
        })->paginate(30);

        return view('site.search', compact('search', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Product $product)
    {
        dispatch(new IncreasProductViewsCountJob($product));
        $product->load(['images']);
        $products = Product::with(['variations.color'])->inRandomOrder()->limit(9)->get();
        return view('site.product', compact('product', 'products'));
    }




    public function custom_designs($product_id)
    {
        $record = Product::with(['variations.color'])->whereId($product_id)->firstOrFail();
        $designs = Design::where('user_id' , '='  , Auth::id())->with('products', 'user')->get();
        return view('site.custom_designs', compact('record', 'designs'));
    }


    public function explore()
    {
        $products = Product::with(['variations.color', 'variations.size'])->latest()->take(15)->get();
        $users = User::latest()->where('type', User::USER)->take(15)->get();
        $designs = Design::latest()->take(15)->get();
        return view('site.explore', compact('products', 'users', 'designs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = Product::with(['variations.color'])->latest()->get();
        $best_sellings = Product::with(['variations.color'])->latest()->get();
        return view('site.products', compact('products', 'best_sellings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function designs()
    {
        $records = Design::latest()->get();
        return view('site.designs', compact('records'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('site.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('site.register');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        return view('site.account');
    }


    public function login_system(LoginRequest $request)
    {

        if (Auth::attempt(['password' => $request->password, 'phone' => $request->mobile], true)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->with('error', 'بيانات الدخول غير صحيحه');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function category_products(Category $category)
    {
        $products = Product::where('active', 1)->where('category_id', $category->id)->latest()->paginate(20);
        return view('site.category_products', compact('category', 'products'));
    }

    public function store_register(RegisterRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->type = 3;
        $user->save();
        Auth::login($user);
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        return redirect(route('site.verify_phone'));
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
