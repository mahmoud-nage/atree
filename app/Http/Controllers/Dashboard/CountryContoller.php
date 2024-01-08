<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Countries\StoreCountryRequest;
use App\Http\Requests\Dashboard\Countries\UpdateCountryRequest;
use App\Models\Country;
use Auth;
use Storage;
use Image;
use Str;
use App\Jobs\ResizeImageAndUploadToAwsJob;
class CountryContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $country = new Country;
        $country->setTranslation('name' , 'ar'  , $request->name_ar );
        $country->setTranslation('name' , 'en'  , $request->name_en );
        $country->active = $request->filled('active') ? 1 : 0;
        $country->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $country->image  = basename($request->file('image')->store('countries'));       

            // $imagePath = $request->file('image')->store('countries' , 'public');       
            // $sizes = [ [56 , 40] ];
            // dispatch(new ResizeImageAndUploadToAwsJob( $imagePath ,  $sizes , 'countries' , 'Country' , $country->id, 'image'));
        }

        $country->save();

        return redirect(route('dashboard.countries.index'))->with('success' , 'تم إضافه الدوله بنجاح' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('dashboard.countries.show' , compact('country') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('dashboard.countries.edit' , compact('country') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->setTranslation('name' , 'ar'  , $request->name_ar );
        $country->setTranslation('name' , 'en'  , $request->name_en );
        $country->active = $request->filled('active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $country->image  = basename($request->file('image')->store('countries'));       

            // $imagePath = $request->file('image')->store('countries' , 'public');       
            // $sizes = [ [56 , 40] ];
            // dispatch(new ResizeImageAndUploadToAwsJob( $imagePath ,  $sizes , 'countries' , 'Country' , $country->id, 'image'));
        }
        
        $country->save();

        return redirect(route('dashboard.countries.index'))->with('success' , 'تم تعديل الدوله بنجاح' );
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
