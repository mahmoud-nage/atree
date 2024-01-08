<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Governorate;
use Auth;
use App\Http\Requests\Dashboard\Governorates\StoreGovernorateRequest;
use App\Http\Requests\Dashboard\Governorates\UpdateGovernorateRequest;
class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.governorates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('dashboard.governorates.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGovernorateRequest $request)
    {
        $governorate = new Governorate;
        $governorate->setTranslation('name' , 'ar' , $request->name_ar );
        $governorate->setTranslation('name' , 'en' , $request->name_en );
        $governorate->user_id = Auth::id();
        $governorate->active = $request->filled('active') ? 1 : 0;
        $governorate->country_id = $request->country_id;
        $governorate->shipping_cost = $request->shipping_cost;
        $governorate->save();
        return redirect(route('dashboard.governorates.index'))->with('success'  , 'تم إضافه المحاظفه بنجاح', 'تم بنجاح' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $governorate)
    {
        $governorate->load(['user' , 'country']);
        return view('dashboard.governorates.show' , compact('governorate') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $governorate)
    {
        $countries = Country::all();
        return view('dashboard.governorates.edit' , compact('governorate', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
    {
        $governorate->setTranslation('name' , 'ar' , $request->name_ar );
        $governorate->setTranslation('name' , 'en' , $request->name_en );
        $governorate->active = $request->filled('active') ? 1 : 0;
        $governorate->country_id = $request->country_id;
        $governorate->shipping_cost = $request->shipping_cost;
        $governorate->save();
        return redirect(route('dashboard.governorates.index'))->with('success'  , 'تم تعديل المحاظفه بنجاح', 'تم بنجاح' );
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
