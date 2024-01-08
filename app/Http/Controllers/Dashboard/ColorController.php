<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Colors\StoreColorRequest;
use App\Http\Requests\Dashboard\Colors\UpdateColorRequest;
use App\Models\Color;
use Auth;
class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.colors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorRequest $request)
    {
        $color = new Color;
        $color->setTranslation('name' , 'ar' , $request->name_ar );
        $color->setTranslation('name' , 'en' , $request->name_en );
        $color->is_active = $request->filled('is_active') ? 1 : 0;
        $color->user_id = Auth::id();
        $color->code = $request->code;
        $color->save();

        return redirect(route('dashboard.colors.index'))->with('success' , 'تم إضافه اللون بنجاح' ); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        return view('dashboard.colors.show' , compact('color') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('dashboard.colors.edit' , compact('color') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $color->setTranslation('name' , 'ar' , $request->name_ar );
        $color->setTranslation('name' , 'en' , $request->name_en );
        $color->is_active = $request->filled('is_active') ? 1 : 0;
        $color->code = $request->code;
        $color->save();

        return redirect(route('dashboard.colors.index'))->with('success' , 'تم تعديل اللون بنجاح' ); 
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
