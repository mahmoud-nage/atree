<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserDesginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.desgins.index');
    }

    public function user_desgins(User $user)
    {
        return view('dashboard.users.desgins' , compact('user') );
    }
}
