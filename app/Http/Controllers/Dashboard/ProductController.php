<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\StoreProductDesignSizesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Country;
use App\Models\Variation;
use Auth;
use Image;
use App\Http\Requests\Dashboard\Products\StoreProductRequest;
use App\Http\Requests\Dashboard\Products\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $countries = Country::all();
        return view('dashboard.products.create', compact('sizes', 'countries', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $product->country_id = $request->country_id;
        $product->price_full_design = $request->price_full_design;
        $product->user_id = Auth::id();
        $product->front_image = basename($request->file('front_image')->store('products'));
        $product->back_image = basename($request->file('back_image')->store('products'));
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
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['images', 'country', 'user']);
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $countries = Country::all();
        return view('dashboard.products.edit', compact('colors', 'countries', 'sizes', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
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
        $product->price_full_design = $request->price_full_design;
        if ($request->hasFile('front_image')) {
            $product->front_image = basename($request->file('front_image')->store('products'));
        }
        if ($request->hasFile('back_image')) {
            $product->back_image = basename($request->file('back_image')->store('products'));
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
     * @return \Illuminate\Http\Response
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
