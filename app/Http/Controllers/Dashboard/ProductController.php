<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\StoreProductDesignSizesRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Country;
use App\Models\Variation;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Image;
use App\Http\Requests\Dashboard\Products\StoreProductRequest;
use App\Http\Requests\Dashboard\Products\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|View
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $countries = Country::all();
        $categories = Category::all();
        return view('dashboard.products.create', compact('sizes', 'countries', 'colors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        // StoreProductRequest
        $image = basename($request->file('front_image')->store('products'));
//
//        $img = Image::make(storage_path() .'/app/public/products/'.$image);
//        $img->colorize(-100, 0, 100);
//        $img->save(storage_path() .'/app/public'.'/products/'. 'ahmedsami.png' , '100');

//        dd($request->all());

        $product = new Product;

        $product->world_code = 'test';
        $product->local_code = 'test';
        $product->unit_id = 1;
        $product->includes_tax = 1;
        $product->carton_includes = 1;

        $product->setTranslation('name', 'ar', $request->name_ar);
        $product->setTranslation('name', 'en', $request->name_en);
        $product->setTranslation('description', 'ar', $request->description_ar);
        $product->setTranslation('description', 'en', $request->description_en);
        $product->price = $request->price;
        $product->diamonds = $request->diamonds;
//        $product->country_id = $request->country_id;
        $product->category_id = $request->category_id;
        $product->price_full_design = $request->price_full_design;
        $product->active = $request->active == 'on' ? 1 : 0;
        $product->show_in_home_page = $request->show_in_home_page == 'on' ? 1 : 0;
        $product->user_id = Auth::id();
        $product->front_image = basename($request->file('front_image')->store('products'));
        $product->back_image = basename($request->file('back_image')->store('products'));

        $product->mobile_back_image = basename($request->file('mobile_back_image')->store('products'));
        $product->mobile_back_tint = basename($request->file('mobile_back_tint')->store('products'));
        $product->mobile_back_shadow = basename($request->file('mobile_back_shadow')->store('products'));
        $product->mobile_front_image = basename($request->file('mobile_front_image')->store('products'));
        $product->mobile_front_tint = basename($request->file('mobile_front_tint')->store('products'));
        $product->mobile_front_shadow = basename($request->file('mobile_front_shadow')->store('products'));
        $product->save();

        if ($request->hasFile('images')) {
            $images = [];
            for ($i = 0; $i < count($request->images); $i++) {
                $images[] = new ProductImage([
                    'product_id' => $product->id,
                    'image' => basename($request->file('images.' . $i)->store('products')),
                ]);
            }
            $product->images()->saveMany($images);
        }

//        for ($i = 0; $i < count($request->colors); $i++) {
//            $variation = new Variation;
//            $variation->product_id = $product->id;
//            $variation->user_id = Auth::id();
//            $variation->size_id = $request->sizes[$i];
//            $variation->color_id = $request->colors[$i];
//            $variation->quantity = $request->quantity[$i];
//            $variation->save();
//        }
        return redirect(route('dashboard.products.index'))->with('success', 'تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Product $product)
    {
        $product->load(['images', 'country', 'user']);
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $countries = Country::all();
        $categories = Category::all();
        return view('dashboard.products.edit', compact('colors', 'countries', 'sizes', 'product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->setTranslation('name', 'ar', $request->name_ar);
        $product->setTranslation('name', 'en', $request->name_en);
        $product->setTranslation('description', 'ar', $request->description_ar);
        $product->setTranslation('description', 'en', $request->description_en);
        $product->price = $request->price;
        $product->diamonds = $request->diamonds;
        $product->country_id = $request->country_id;
        $product->category_id = $request->category_id;
        $product->price_full_design = $request->price_full_design;
        $product->active = $request->active == 'on' ? 1 : 0;
        $product->show_in_home_page = $request->show_in_home_page == 'on' ? 1 : 0;
        if ($request->hasFile('front_image')) {
            $product->front_image = basename($request->file('front_image')->store('products'));
        }
        if ($request->hasFile('back_image')) {
            $product->back_image = basename($request->file('back_image')->store('products'));
        }


        if ($request->hasFile('mobile_back_image')) {
            $product->mobile_back_image = basename($request->file('mobile_back_image')->store('products'));
        }
        if ($request->hasFile('mobile_back_tint')) {
            $product->mobile_back_tint = basename($request->file('mobile_back_tint')->store('products'));
        }
        if ($request->hasFile('mobile_back_shadow')) {
            $product->mobile_back_shadow = basename($request->file('mobile_back_shadow')->store('products'));
        }
        if ($request->hasFile('mobile_front_image')) {
            $product->mobile_front_image = basename($request->file('mobile_front_image')->store('products'));
        }
        if ($request->hasFile('mobile_front_tint')) {
            $product->mobile_front_tint = basename($request->file('mobile_front_tint')->store('products'));
        }
        if ($request->hasFile('mobile_front_shadow')) {
            $product->mobile_front_shadow = basename($request->file('mobile_front_shadow')->store('products'));
        }

        $product->save();


        if ($request->hasFile('images')) {
            $images = [];
            for ($i = 0; $i < count($request->images); $i++) {
                $images[] = new ProductImage([
                    'product_id' => $product->id,
                    'image' => basename($request->file('images.' . $i)->store('products')),
                ]);
            }
            $product->images()->saveMany($images);
        }

        return redirect(route('dashboard.products.index'))->with('success', trans('products.editing_success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StoreProductDesignSizesRequest $request
     * @return RedirectResponse
     */
    public function store_design_sizes(StoreProductDesignSizesRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $product = Product::findOrFail($request->product_id);
        unset($data['product_id']);
        $product->update($data);
        return back()->with('success', trans('products.editing_success'));
    }
}
