<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Design;
use App\Models\Income;
use App\Models\UserDesign;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{


    public function index()
    {
        $slides = Slide::where('is_active', 1)->latest()->get();
        $recomanded_users = User::where('type', User::USER)->where('profile_status', 1)->where('id', '!=', auth()->id())->orderByRaw("RAND()")->take(8)->get();
        $categories = Category::inRandomOrder()->where('show_in_home_page', 1)->where('active', 1)->with(['products' => function ($q) {
            $q->where('show_in_home_page',1);
        }])->get();
        $designs = UserDesign::inRandomOrder()->with('product')->where('is_active', 1)->take(6)->get();
        $bestSellingProducts = UserDesign::inRandomOrder()->with('product')->orderBy('times_used_count', 'desc')->where('is_active', 1)->take(10)->get();
        $mostViewedDesigns = UserDesign::inRandomOrder()->with('product')->where('is_active', 1)->orderBy('views_count', 'desc')->take(8)->get();
        return view('site.index', compact('slides', 'recomanded_users', 'categories', 'designs', 'bestSellingProducts', 'mostViewedDesigns'));
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

    public function user($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->load('designs')->loadCount('followers');
        $latest_designs = UserDesign::where('user_id', $user->id)->latest()->get()->take(4);
        $total_incomes = Income::where('user_id', Auth::id())->where('withdrawn', 0)->sum('amount');
        $total_points = Income::where('user_id', Auth::id())->where('withdrawn', 0)->sum('points');
        return view('site.bio', compact('user', 'latest_designs', 'total_incomes', 'total_points'));
    }


    public function contact()
    {
        return view('site.contact');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $products = Product::with(['variations', 'variations.color'])->whereActive(1)->where(function ($query) use ($search) {
            $query
                ->where('name->ar', 'LIKE', '%' . $search . '%')
                ->orWhere('name->en', 'LIKE', '%' . $search . '%')
                ->orWhere('description->ar', 'LIKE', '%' . $search . '%')
                ->orWhere('description->en', 'LIKE', '%' . $search . '%');
        })->get();
        $users = User::latest()->where('type', User::USER)->where('profile_status', 1)->where('name', 'LIKE', '%' . $search . '%')->get();

        return view('site.search', compact('search', 'products','users'));
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
        $products = Product::with(['variations.color'])->inRandomOrder()->whereActive(1)->limit(9)->get();
        return view('site.product', compact('product', 'products'));
    }


    public function custom_designs(Request $request, $product_id)
    {
        $design = null;
        if ($request->type == 'design') {
            $design = UserDesign::findOrFail($product_id);
            $design->increment('times_used_count');
            $products = Product::whereIn('id', $design->products->where('id', '!=', $design->product_id)->pluck('id'))->whereActive(1)->get();
            $product_id = $design->product_id;
        } else {
            $products = Product::where('id', '!=', $product_id)->get();
        }
        $record = Product::with(['variations.color'])->whereId($product_id)->firstOrFail();
        $designs = UserDesign::where('user_id', '=', Auth::id())->with('products', 'user')->get();
        return view('site.custom_designs', compact('record', 'designs', 'products', 'design'));
    }

    public function current_custom_designs(Request $request, $product_id)
    {
        $design = null;
        if ($request->type == 'design') {
            $design = UserDesign::findOrFail($product_id);
            $design->increment('times_used_count');
            $products = Product::whereIn('id', $design->products->where('id', '!=', $design->product_id)->pluck('id'))->whereActive(1)->get();
            $product_id = $design->product_id;
        } else {
            $products = Product::where('id', '!=', $product_id)->get();
        }
        $record = Product::with(['variations.color'])->whereId($product_id)->firstOrFail();
        $designs = UserDesign::where('user_id', '=', Auth::id())->with('products', 'user')->get();
        return view('site.current_custom_designs', compact('record', 'designs', 'products', 'design'));
    }


    public function explore()
    {
        $products = Product::with(['variations.color', 'variations.size'])->whereActive(1)->latest('sales_count')->take(15)->get();
        $users = User::latest()->where('type', User::USER)->where('profile_status', 1)->take(15)->get();
        $designs = UserDesign::with('product')->latest()->take(15)->get();
        return view('site.explore', compact('products', 'users', 'designs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function products(Request $request)
    {
        $products = Product::with(['variations.color'])->whereActive(1);
        $best_sellings = Product::with(['variations.color'])->whereActive(1);
        if ($request->category_id && $request->category_id != 'all' ) {
            $products->where('category_id', $request->category_id);
            $best_sellings->where('category_id', $request->category_id);
        }
        $products = $products->latest()->get();
        $best_sellings = $best_sellings->latest('sales_count')->take(10)->get();
        $categories = Category::has('products')->whereActive(1)->get();
        return view('site.products', compact('products', 'best_sellings','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|Factory|View
     */
    public function designs(Request $request)
    {
        $records = UserDesign::with('product');
        if ($request->product_id && $request->product_id != 'all' ) {
            $records->whereHas('design_products', function ($q) use ($request) {
                $q->where('product_id', $request->product_id);
            });
        }
        $records = $records->latest()->orderBy('times_used_count', 'desc')->get();
        $products = Product::has('design_products')->whereActive(1)->get();
        return view('site.designs', compact('records','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateDesign(Request $request, $id): RedirectResponse
    {
        $record = UserDesign::findOrFail($id);
        $record->description = $request->description;
        $record->is_active = $request->is_active == 'on' ? 1 : 0;
        $record->save();
        $record->products()->sync($request->product_id);
        return back()->with('success', 'success');
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
