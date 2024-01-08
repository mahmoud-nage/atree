<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
class FacebookAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        $finduser = User::where('facebook_id', $user->id)->first();
        if($finduser){
            Auth::login($finduser);
            return redirect('/');
        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id'=> $user->id ,
            ]);
            Auth::login($newUser);
            return redirect('/');
        }
    }


}
