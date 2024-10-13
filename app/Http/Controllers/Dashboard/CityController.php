<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Governorate;
use Auth;

use App\Http\Requests\Dashboard\Cities\StoreCityRequest;
use App\Http\Requests\Dashboard\Cities\UpdateCityRequest;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();
        return view('dashboard.cities.create' , compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        $city = new City;
        $city->setTranslation('name' , 'ar' , $request->name_ar);
        $city->setTranslation('name' , 'en' , $request->name_en);
        $city->governorate_id = $request->governorate_id;
        $city->shipping_cost = $request->shipping_cost;
        $city->user_id = Auth::id();
        $city->active = $request->filled('active') ? 1 : 0;
        $city->save();
        return redirect(route('dashboard.cities.index'))->with('success', __('messages.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('dashboard.cities.show' , compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $governorates = Governorate::all();
        return view('dashboard.cities.edit' , compact('city' , 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->setTranslation('name' , 'ar' , $request->name_ar);
        $city->setTranslation('name' , 'en' , $request->name_en);
        $city->governorate_id = $request->governorate_id;
        $city->active = $request->filled('active') ? 1 : 0;
        $city->shipping_cost = $request->shipping_cost;
        $city->save();
        return redirect(route('dashboard.cities.index'))->with('success', __('messages.updated_successfully'));
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
