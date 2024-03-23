<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CartRequest;
use App\Models\Cart;
use App\Models\UserDesign;
use App\Models\Variation;
use App\Models\Product;
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
        $product = Product::find($request->product_id);
        $color = $request->design_color_id;
        if ($request->design_front_photo && $request->design_back_photo) {
            $price = $product->price_full_design;
        } else {
            $price = $product->price;
        }
        if ($request->design_front_photo) {
            $waterMarkExtension = explode('/', explode(':', substr($request->design_front_photo, 0, strpos($request->design_front_photo, ';')))[1])[1];
            $designFrontFileName = time() . Str::random(10) . '.jpeg';
            $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
            $waterMarkUrl = Image::make(file_get_contents($request->design_front_photo));
            $image = Image::make(file_get_contents(storage_path('app/public/products/' . $product->front_image)));
            $image->resize($request->main_image_width, $request->main_image_height)->colorize($this->hexToRgb($color, 'r'), $this->hexToRgb($color, 'g'), $this->hexToRgb($color, 'b'))
                ->insert($waterMarkUrl, 'top-left', $product->site_front_top, $product->site_front_left)->encode('jpeg', 100)
                ->save(storage_path('app/public/designs/' . $designFrontFileName));
            $waterMarkUrl->save(storage_path('app/public/designs/' . $waterMarkFrontFileName));
        }
        if ($request->design_back_photo) {
            $waterMarkExtension = explode('/', explode(':', substr($request->design_back_photo, 0, strpos($request->design_back_photo, ';')))[1])[1];
            $designBackFileName = time() . Str::random(10) . '.jpeg';
            $waterMarkBackFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
            $waterMarkBackUrl = Image::make(file_get_contents($request->design_back_photo));
            $image = Image::make(file_get_contents(storage_path('app/public/products/' . $product->back_image)));
            $image->resize($request->main_image_width, $request->main_image_height)->colorize($this->hexToRgb($color, 'r'), $this->hexToRgb($color, 'g'), $this->hexToRgb($color, 'b'))
                ->insert($waterMarkBackUrl, 'top-left', $product->site_back_top, $product->site_back_left)->encode('jpeg', 100)
                ->save(storage_path('app/public/designs/' . $designBackFileName));
            $waterMarkBackUrl->save(storage_path('app/public/designs/' . $waterMarkBackFileName));
        }
        UserDesign::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
//            'designer_id' => auth()->id(),
            'image' => $waterMarkFrontFileName,
            'back_image' => $waterMarkBackFileName,
        ]);
        foreach ($request->size_id as $key => $size) {
            $variation = Variation::where('product_id', $request->product_id)
                ->where('color_id', $request->color_id[$key])
                ->where('size_id', $size)->first();
            Cart::create([
                'product_id' => $request->product_id,
                'variation_id' => $variation->id,
                'price' => $price,
                'quantity' => $request->quantities[$key],
                'user_id' => auth()->id(),
                'design_front_image' => $designFrontFileName ?? null,
                'design_back_image' => $designBackFileName ?? null,
            ]);
        }
        return view('site.cart');
    }

    function hexToRgb($hex, $alpha)
    {
        $hex = str_replace('#', '', $hex);
        $length = strlen($hex);
        if ($alpha == 'r') {
            $rgb = hexdec(substr($hex, 0, 2)) * 100/255;
        } elseif ($alpha == 'g') {
            $rgb = hexdec(substr($hex, 2, 2)) * 100/255;
        } elseif ($alpha == 'b') {
            $rgb = hexdec(substr($hex, 4, 2)) * 100/255;
        }
        return ceil($rgb);
    }
}
