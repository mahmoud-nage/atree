<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CartRequest;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Design;
use App\Models\UserDesign;
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
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CartController extends Controller
{
    public function index()
    {
        return view('site.cart');
    }

    public function create()
    {
        return view('site.cart');
    }

    public function store(CartRequest $request)
    {

//        $product = Product::find($request->product_id);
//        $image = Image::make(file_get_contents($request->mainImg))
//            ->save(public_path('\designs\pic1-new.png'));
//        $waterMarkUrl = Image::make(file_get_contents($request->pngFrontURL));
//        $image->insert($waterMarkUrl, 'top-left', (int)$request->image_front_top + $product-> site_front_top, (int)$request->image_front_left + $product-> site_front_left);
//        $image->save(public_path('\designs\pic2-new.png'));
//        dd($request->all());
        $product = Product::find($request->product_id);
        $color = Color::find($request->color_id);

        if ($request->design_back_photo && $request->design_back_photo) {
            $price = $product->price_full_design;
        } else {
            $price = $product->price;
        }

        if ($request->design_front_photo) {
            $waterMarkExtension = explode('/', explode(':', substr($request->design_front_photo, 0, strpos($request->design_front_photo, ';')))[1])[1];
            $designFrontFileName = time() . Str::random(10) . '.jpeg';
            $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
            $waterMarkUrl = Image::make(file_get_contents($request->design_front_photo));
            $image = Image::make(file_get_contents(storage_path('app\public\products\\'.$product->front_image)));
            $image->resize($request->main_image_width,$request->main_image_height)->colorize(0,0,0)
                ->insert($waterMarkUrl, 'top-left', $product->site_front_top, $product->site_front_left)->encode('jpeg', 100)
                ->save(storage_path('app\public\designs\\' . $designFrontFileName));
            $waterMarkUrl->save(storage_path('app\public\designs\\' . $waterMarkFrontFileName));
            UserDesign::create([
                'user_id' => auth()->id(),
                'image' => $waterMarkFrontFileName,
            ]);

        }
//        if ($request->image_front_src) {
//            $mainExtension = explode('/', explode(':', substr($request->mainImg, 0, strpos($request->mainImg, ';')))[1])[1];
//            $waterMarkExtension = explode('/', explode(':', substr($request->pngFrontURL, 0, strpos($request->pngFrontURL, ';')))[1])[1];
//            $designFrontFileName = time() . Str::random(10) . '.' . $mainExtension;
//            $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
//
//            $waterMarkUrl = Image::make(file_get_contents($request->pngFrontURL));
//            $image = Image::make(file_get_contents($request->mainImg));
//            $image->insert($waterMarkUrl, 'top-left', (int)$request->image_front_top + $product->site_front_top, (int)$request->image_front_left + $product->site_front_left)
//                ->save(storage_path('app\public\designs\\' . $designFrontFileName));
//            $waterMarkUrl->save(storage_path('app\public\designs\\' . $waterMarkFrontFileName));
//            UserDesign::create([
//                'user_id' => auth()->id(),
//                'image' => $waterMarkFrontFileName,
//            ]);
//        }
//        if ($request->image_back_src) {
//            $mainExtension = explode('/', explode(':', substr($request->mainBackImg, 0, strpos($request->mainBackImg, ';')))[1])[1];
//            $waterMarkExtension = explode('/', explode(':', substr($request->pngBackURL, 0, strpos($request->pngBackURL, ';')))[1])[1];
//            $designBackFileName = time() . Str::random(10) . '.' . $mainExtension;
//            $waterMarkBackFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
//
//            $waterMarkUrl = Image::make(file_get_contents($request->pngBackURL));
//            $image = Image::make(file_get_contents($request->mainBackImg));
//            $image->insert($waterMarkUrl, 'top-left', (int)$request->image_back_top + $product->site_back_top, (int)$request->image_back_left + $product->site_back_left)
//                ->save(storage_path('app\public\designs\\' . $designBackFileName));
//            $waterMarkUrl->save(storage_path('app\public\designs\\' . $waterMarkBackFileName));
//            Design::create([
//                'user_id' => auth()->id(),
//                'image' => $waterMarkBackFileName,
//            ]);
//
////            $waterMarkUrlBack = Image::make($request->file('image_back_src'))
////                ->resize(floor($request->image_back_width * 0.23), floor($request->image_back_height * 0.22))
////                ->save(public_path('\designs\pic1-new.png'));
////            $imageBack = Image::make(public_path(Storage::url('products/' . $product->back_image)));
////            /* insert watermark at bottom-left corner with 5px offset */
////            $imageBack->insert($waterMarkUrlBack, 'top-left', floor($request->image_back_top * 0.23), floor($request->image_back_left * 0.23));
////            $imageBack->encode('webp')->save(public_path('\designs\pic2-new.png'));
//        }

        foreach ($request->sizes as $key => $size){
            $variation = Variation::where('product_id', $request->product_id)
                ->where('color_id', $request->color_id)
                ->where('size_id', $size)->first();
            Cart::create([
                'product_id' => $request->product_id,
                'variation_id' => $variation->id,
                'price' => $price,
                'quantity' => $request->quantities[$key],
                'user_id' => auth()->id(),
                'design_front_image' => $designFrontFileName ?? null,
                'design_back_image' =>$designBackFileName ?? null,
            ]);
        }

        return view('site.cart');
    }

    function hexToRgb($hex, $alpha = false) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ( $alpha ) {
            $rgb['a'] = $alpha;
        }
        return $rgb;
    }
}
