<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CartRequest;
use App\Models\Cart;
use App\Models\UserDesign;
use App\Models\Variation;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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
        $designs = [];
        foreach ($request->product_id as $key => $product) {
            $product = Product::find($product);
            if ($key == 0) {
                if ($request->image && $request->image != 'data:,') {
                    $designFrontFileName1 = time() . Str::random(10) . '.png';
                    Image::make(file_get_contents($request->image))->save(storage_path('app/public/designs/' . $designFrontFileName1));
                }
                if ($request->image1 && $request->image1 != 'data:,') {
                    $designBackFileName1 = time() . Str::random(10) . '.png';
                    Image::make(file_get_contents($request->image1))->save(storage_path('app/public/designs/' . $designBackFileName1));
                }

                if ($request->design_front_photo) {
                    $waterMarkExtension = explode('/', explode(':', substr($request->design_front_photo, 0, strpos($request->design_front_photo, ';')))[1])[1];
                    $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                    $waterMarkUrl = Image::make(file_get_contents($request->design_front_photo));
                    $waterMarkUrl->save(storage_path('app/public/designs/' . $waterMarkFrontFileName));
                }
                if ($request->design_back_photo) {
                    $waterMarkExtension = explode('/', explode(':', substr($request->design_back_photo, 0, strpos($request->design_back_photo, ';')))[1])[1];
                    $waterMarkBackFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                    $waterMarkBackUrl = Image::make(file_get_contents($request->design_back_photo));
                    $waterMarkBackUrl->save(storage_path('app/public/designs/' . $waterMarkBackFileName));
                }

            }
            if ($request->design_front_photo) {
                $waterMarkExtension = explode('/', explode(':', substr($request->design_front_photo, 0, strpos($request->design_front_photo, ';')))[1])[1];
                $designFrontFileName = time() . Str::random(10) . '.png';
                $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                $waterMarkUrl = Image::make(file_get_contents($request->design_front_photo))
                    ->resize((int)$request->front_image_width, (int)$request->front_image_height);
//                    ->resize(floor($request->front_image_width / $product->site_front_width) * $request->front_image_width, floor($request->front_image_height / $product->site_front_height) * $request->front_image_height);
                $image = Image::make(file_get_contents(storage_path('app/public/products/' . $product->front_image)));
                $image->insert($waterMarkUrl, 'top-left', (int)$product->site_front_top, (int)$product->site_front_left)->encode('png', 100)
                    ->save(storage_path('app/public/designs/' . $designFrontFileName));
                $waterMarkUrl->save(storage_path('app/public/designs/' . $waterMarkFrontFileName));
            }
            if ($request->design_back_photo) {
                $waterMarkExtension = explode('/', explode(':', substr($request->design_back_photo, 0, strpos($request->design_back_photo, ';')))[1])[1];
                $designBackFileName = time() . Str::random(10) . '.png';
                $waterMarkBackFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                $waterMarkBackUrl = Image::make(file_get_contents($request->design_back_photo))
                    ->resize((int)$request->back_image_width, (int)$request->back_image_height);
//                    ->resize(floor($request->back_image_width / $product->site_back_width) * $request->back_image_width, floor($request->back_image_height / $product->site_back_height) * $request->back_image_height);
                $image = Image::make(file_get_contents(storage_path('app/public/products/' . $product->back_image)));
                $image->insert($waterMarkBackUrl, 'top-left', (int)$product->site_back_top, (int)$product->site_back_left)->encode('png', 100)
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
                'main_color_code' => $request->design_color_id,
                'created_at' => now(),
            ];
        }
        DB::table('user_designs')->insert($designs);
        $design = auth()->user()->designs()->whereDate('created_at', now())->first();
        if ($request->type == 1) {
            $product = Product::find($request->product_id[0]);
            $color = $request->design_color_id;
            if ($request->design_front_photo && $request->design_back_photo) {
                $price = $product->price_full_design;
            } else {
                $price = $product->price;
            }
            foreach ($request->size_id as $key => $size) {
                $variation = Variation::where('product_id', $request->product_id)
                    ->where('color_id', $request->color_id[$key])
                    ->where('size_id', $size)->first();
                Cart::create([
                    'design_id' => $design->id,
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'price' => $price,
                    'quantity' => $request->quantities[$key],
                    'user_id' => auth()->id(),
                    'design_front_image' => $designFrontFileName1 ?? null,
                    'design_back_image' => $designBackFileName1 ?? null,
                ]);
            }
        }
        return $request->type == 1 ? view('site.cart') : redirect(route('users.show', auth()->user()));
    }
}
