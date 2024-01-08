<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Storage;
use App\Http\Requests\Dashboard\Admins\StoreAdminRequest;
use App\Http\Requests\Dashboard\Admins\UpdateAdminRequest;
use App\Jobs\DeleteImagesFromAWSJob;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $admin = new User;
        if(!$admin->add($request->all()))
            return back()->with('error' , trans('admins.adding_error'));

        if($request->hasFile('image')) {
            $admin->image = basename($request->file('image')->store('admins'));
            $admin->save();
        }

        return redirect(route('dashboard.admins.index'))->with('success' , 'تم إضافه المشرف بنجاح' );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        $admin->load('admin');
        return view('dashboard.admins.show' , compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('dashboard.admins.edit' , compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request,User $admin)
    {
        if(!$admin->edit($request->all()))
            return back()->with('error' , trans('admins.editing_error'));

        if($request->hasFile('image')) {
            $image = 'admins/'.$admin->image;
            DeleteImagesFromAWSJob::dispatch($image);
            $admin->image = basename($request->file('image')->store('admins'));
            $admin->save();
        }

        return redirect(route('dashboard.admins.index'))->with('success' , trans('editing_success') );
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
