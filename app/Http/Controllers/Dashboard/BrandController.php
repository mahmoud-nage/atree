<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\Dashboard\Brands\StoreBrandRequest;
use App\Http\Requests\Dashboard\Brands\UpdateBrandRequest;
use App\Jobs\DeleteImagesFromAWSJob;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new brand;
        if(!$brand->add($request->all()))
            return back()->with('error' , trans('brands.adding_error'));

        $brand->logo = basename($request->file('logo')->store('brands'));
        $brand->save();

        return redirect(route('dashboard.brands.index'))->with('success' , trans('brands.adding_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $brand->load('user');
        return view('dashboard.brands.show' , compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit' , compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
         if(!$brand->edit($request->all()))
            return back()->with('error' , trans('brands.editing_error'));

        if ($request->hasFile('logo')) {
            $image = 'brands/'.$brand->logo;
            DeleteImagesFromAWSJob::dispatch($image);
            $brand->logo = basename($request->file('logo')->store('brands'));
            $brand->save();
        }

        return redirect(route('dashboard.brands.index'))->with('success' , trans('brands.editing_success'));
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
