<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CartRequest;
use App\Models\Cart;
use App\Models\DesignProduct;
use App\Models\UserDesign;
use App\Models\Variation;
use App\Models\Product;
use AWS\CRT\Log;
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

    public function store(CartRequest $request) //
    {
        try {
            DB::beginTransaction();
            $details = [];
            $details_back = [];
            if ($request->front_text_content && count($request->front_text_content) > 0) {
                foreach ($request->front_text_content as $key => $text) {
                    $details[] = [
                        'type' => 'text',
                        'content' => $text,
                        'color' => $request->front_color[$key] ?? '-',
                        'font_family' => $request->front_font_family[$key] ?? '-',
                        'size' => $request->front_font_size[$key] ?? '-',
                        'weight' => $request->front_font_weight[$key] ?? '-',
                    ];
                }
            }
            if ($request->back_text_content && count($request->back_text_content) > 0) {
                foreach ($request->back_text_content as $key => $text) {
                    $details_back[] = [
                        'type' => 'text',
                        'content' => $text,
                        'color' => $request->back_color[$key] ?? '-',
                        'font_family' => $request->back_font_family[$key] ?? '-',
                        'size' => $request->back_font_size[$key] ?? '-',
                        'weight' => $request->back_font_weight[$key] ?? '-',
                    ];
                }
            }
            if ($request->front_image && count($request->front_image) > 0) {
                foreach ($request->front_image as $key => $image) {
                    $imageExt = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                    $imageName = time() . Str::random(10) . '.' . $imageExt;
                    $newImage = Image::make(file_get_contents($image));
                    $newImage->save(storage_path('app/public/designs/' . $imageName));
                    $details[] = [
                        'type' => 'image',
                        'content' => $imageName ?? '-', //
                        'color' => '-',
                        'font_family' => '-',
                        'size' => '-',
                        'weight' => '-',
                    ];
                }
            }
            if ($request->back_image && count($request->back_image) > 0) {
                foreach ($request->back_image as $key => $image) {
                    $imageExt = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                    $imageName = time() . Str::random(10) . '.' . $imageExt;
                    $newImage = Image::make(file_get_contents($image));
                    $newImage->save(storage_path('app/public/designs/' . $imageName));
                    $details_back[] = [
                        'type' => 'image',
                        'content' => $imageName ?? '-', //
                        'color' => '-',
                        'font_family' => '-',
                        'size' => '-',
                        'weight' => '-',
                    ];
                }
            }
            if ($request->type == 'design') {
                $design = UserDesign::find($request->design_id);
                $design->increment('views_count');
                $product = Product::find($request->products[0]);
                if ($design->design_image_front && $design->design_image_back) {
                    $price = $product->price_full_design;
                } else {
                    $price = $product->price;
                }
                foreach ($request->size_id as $key => $size) {
                    $variation = Variation::where('product_id', $product->id)
                        ->where('color_id', $request->color_id[$key])
                        ->where('size_id', $size)->first();
                    Cart::create([
                        'design_id' => $design->id,
                        'product_id' => $product->id,
                        'variation_id' => $variation->id,
                        'price' => $price,
                        'quantity' => $request->quantities[$key],
                        'user_id' => auth()->id(),
                        'design_front_image' => $design->design_image_front ?? null,
                        'design_back_image' => $design->design_image_back ?? null,
                        'details' => $design->details ?? null,
                        'details_back' => $design->details_back ?? null,
                    ]);
                }
                return view('site.cart');
            }
            $designs = [];
            if ($request->frontImageFile) {
                $waterMarkExtension = explode('/', explode(':', substr($request->frontImageFile, 0, strpos($request->frontImageFile, ';')))[1])[1];
                $waterMarkFrontFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                $waterMarkUrl = Image::make(file_get_contents($request->frontImageFile));
                $waterMarkUrl->save(storage_path('app/public/designs/' . $waterMarkFrontFileName));
            }
            if ($request->backImageFile) {
                $waterMarkExtension = explode('/', explode(':', substr($request->backImageFile, 0, strpos($request->backImageFile, ';')))[1])[1];
                $waterMarkBackFileName = time() . Str::random(10) . '.' . $waterMarkExtension;
                $waterMarkBackUrl = Image::make(file_get_contents($request->backImageFile));
                $waterMarkBackUrl->save(storage_path('app/public/designs/' . $waterMarkBackFileName));
            }
            $product = Product::find($request->products[0]);
            $design = UserDesign::create([
                'user_id' => auth()->id(),
                'product_id' => $request->products[0],
                'image' => $product->front_image ?? '',
                'back_image' => $product->back_image ?? '',
                'design_image_front' => $waterMarkFrontFileName ?? '',
                'design_image_back' => $waterMarkBackFileName ?? '',
                'main_color_code' => $request->design_color_id,
                'details' => $details ?? null,
                'details_back' => $details_back ?? null,
            ]);
            foreach ($request->products as $key => $product) {
                DesignProduct::create([
                    'design_id' => $design->id,
                    'product_id' => $product,
                ]);
            }
            if ($request->submit_type == 1) {
                $product = Product::find($request->products[0]);
                $color = $request->design_color_id;
                if ($request->frontImageFile && $request->backImageFile) {
                    $price = $product->price_full_design;
                } else {
                    $price = $product->price;
                }
                foreach ($request->size_id as $key => $size) {
                    $variation = Variation::where('product_id', $request->products[0])
                        ->where('color_id', $request->color_id[$key])
                        ->where('size_id', $size)->first();
                    Cart::create([
                        'design_id' => $design->id,
                        'product_id' => $product->id,
                        'variation_id' => $variation->id,
                        'price' => $price,
                        'quantity' => $request->quantities[$key],
                        'user_id' => auth()->id(),
                        'design_front_image' => $waterMarkFrontFileName ?? '',
                        'design_back_image' => $waterMarkBackFileName ?? '',
                        'details' => $design->details ?? null,
                        'details_back' => $design->details_back ?? null,
                    ]);
                }
            }
            DB::commit();
            return $request->submit_type == 1 ? view('site.cart')->with('success', __('messages.created_successfully')) : redirect(route('users.show', auth()->user()))->with('success', __('messages.created_successfully'));

        } catch (\Throwable $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('cart store', [$e->getMessage()]);
            return back()->with('error', __('messages.wrong'));
        }
    }
}
