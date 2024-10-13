<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Dashboard\Sizes\StoreSizeRequest;
use App\Http\Requests\Dashboard\Sizes\UpdateSizeRequest;
use App\Models\Size;
class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.designs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.designs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSizeRequest $request)
    {
        $size = new Size;
        $size->setTranslation('name' , 'ar' , $request->name_ar );
        $size->setTranslation('name' , 'en' , $request->name_en );
        $size->user_id = Auth::id();
        $size->is_active = $request->filled('is_active') ? 1 : 0;
        $size->save();

        return redirect(route('dashboard.designs.index'))->with('success', __('messages.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return view('dashboard.designs.show' , compact('size') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('dashboard.designs.edit' , compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        $size->setTranslation('name' , 'ar' , $request->name_ar );
        $size->setTranslation('name' , 'en' , $request->name_en );
        $size->is_active = $request->filled('is_active') ? 1 : 0;
        $size->save();

        return redirect(route('dashboard.designs.index'))->with('success', __('messages.updated_successfully'));
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
