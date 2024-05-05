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

class UserDesignController extends Controller
{
    public function store(CartRequest $request)
    {
        if ($request->image && $request->image != 'data:,') {
//            $waterMarkExtension = explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            $designFrontFileName = time() . Str::random(10) . '.png';
            Image::make(file_get_contents($request->image))->save(storage_path('app/public/designs/' . $designFrontFileName));
        }
        if ($request->image1 && $request->image1 != 'data:,') {
//            $waterMarkExtension = explode('/', explode(':', substr($request->image1, 0, strpos($request->image1, ';')))[1])[1];
            $designBackFileName = time() . Str::random(10) . '.png';
            Image::make(file_get_contents($request->image1))->save(storage_path('app/public/designs/' . $designBackFileName));
        }

//        dd('test');
        $designs = [];
        foreach ($request->products as $product) {
            $product = Product::find($product);
            if ($request->design_front_photo) {
                $waterMarkExtension = explode('/', explode(':', substr($request->design_front_photo, 0, strpos($request->design_front_photo, ';')))[1])[1];
                $designFrontFileName = time() . Str::random(10) . '.png';
                $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                $waterMarkUrl = Image::make(file_get_contents($request->design_front_photo));
                $image = Image::make(file_get_contents(storage_path('app/public/products/' . $product->front_image)));
                $image->insert($waterMarkUrl, 'top-left', $product->site_front_top, $product->site_front_left)->encode('png', 100)
                    ->save(storage_path('app/public/designs/' . $designFrontFileName));
                $waterMarkUrl->save(storage_path('app/public/designs/' . $waterMarkFrontFileName));
            }
            if ($request->design_back_photo) {
                $waterMarkExtension = explode('/', explode(':', substr($request->design_back_photo, 0, strpos($request->design_back_photo, ';')))[1])[1];
                $designBackFileName = time() . Str::random(10) . '.png';
                $waterMarkBackFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                $waterMarkBackUrl = Image::make(file_get_contents($request->design_back_photo));
                $image = Image::make(file_get_contents(storage_path('app/public/products/' . $product->back_image)));
                $image->insert($waterMarkBackUrl, 'top-left', $product->site_back_top, $product->site_back_left)->encode('png', 100)
                    ->save(storage_path('app/public/designs/' . $designBackFileName));
                $waterMarkBackUrl->save(storage_path('app/public/designs/' . $waterMarkBackFileName));
            }
            $designs[] = [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'image' => $designFrontFileName,
                'back_image' => $designBackFileName,
                'design_image_front' => $waterMarkFrontFileName,
                'design_image_back' => $waterMarkBackFileName,
            ];
        }
        UserDesign::create($designs);
        return view('site.my_designs');
    }
}
