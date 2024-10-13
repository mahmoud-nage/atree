<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Storage;
use App\Http\Requests\Dashboard\Admins\StoreAdminRequest;
use App\Http\Requests\Dashboard\Admins\UpdateAdminRequest;
use App\Jobs\DeleteImagesFromAWSJob;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('dashboard.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdminRequest $request
     * @return Application|RedirectResponse|Redirector
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

        return redirect(route('dashboard.admins.index'))->with('success', __('messages.created_successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|Response
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
     * @return Response
     */
    public function edit(User $admin)
    {
        return view('dashboard.admins.edit' , compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
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

        return redirect(route('dashboard.admins.index'))->with('success', __('messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
