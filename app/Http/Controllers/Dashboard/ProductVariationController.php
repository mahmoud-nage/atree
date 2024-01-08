<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Size;
use Auth;
class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $sizes = Size::all();
        return view('dashboard.variations.create' , compact('product' , 'sizes') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Product $product)
    {

        for ($i=0; $i <count($request->types) ; $i++) { 
            $new_product_variat = new Variation;
            $new_product_variat->product_id = $product->id;
            $new_product_variat->title = $request->name[$i];
            $new_product_variat->price = $request->price[$i];
            $new_product_variat->type = $request->types[$i] ;
            $new_product_variat->barcode = $request->barcode[$i] ;
            $new_product_variat->user_id = Auth::id();
            $new_product_variat->save();
            if ($request->color_barcode) {
                for ($r=0; $r <count($request->color_barcode[$i]) ; $r++) { 
                    $product_sub_variat = new Variation;
                    $product_sub_variat->product_id = $product->id;
                    $product_sub_variat->parent_id = $new_product_variat->id;
                    $product_sub_variat->title = $request->color_names[$i][$r];
                    $product_sub_variat->color = $request->colors[$i][$r];
                    $product_sub_variat->price = $request->color_prices[$i][$r];
                    $product_sub_variat->barcode = $request->color_barcode[$i][$r] ;
                    $product_sub_variat->type = 'color';
                    $product_sub_variat->user_id = Auth::id();
                    $product_sub_variat->save();
                }
            }
        }
        return redirect(route('dashboard.products.index'))->with('success' , 'تم الاضافه بنجاح' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
