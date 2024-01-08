<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show' , compact('user') );
    }
    public function orders($user_id)
    {
        $marketer = Order::where('user_id', $user_id)->get();
        return view('dashboard.users.orders', compact('marketer'));
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
