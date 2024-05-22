<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Users\UpdateUserRequest;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.users.index');
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('dashboard.users.show' , compact('user') );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit' , compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request,User $user)
    {
        if(!$user->edit($request->all()))
            return back()->with('error' , trans('users.editing_error'));

        if($request->hasFile('image')) {
            $image = 'users/'.$user->image;
            DeleteImagesFromAWSJob::dispatch($image);
            $user->image = basename($request->file('image')->store('admins'));
            $user->save();
        }

        return redirect(route('dashboard.users.index'))->with('success' , trans('editing_success') );
    }




    public function orders(User $user)
    {
        $records = $user->orders;
        return view('dashboard.users.orders', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LoginRequest  $request
     * @return RedirectResponse
     */
    public function login($user_id)
    {
        Auth::loginUsingId($user_id);
        return redirect()->route('dashboard.users.orders', $user_id);
    }

}
