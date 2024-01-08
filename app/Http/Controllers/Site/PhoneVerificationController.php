<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhoneVerificationCode;
use Auth;
use Session;
use Carbon\Carbon;
class PhoneVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.verify_phone');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = PhoneVerificationCode::where([
            ['code' , '=' , $request->code ] , 
            ['phone' , '=' , Auth::user()->phone ]
        ])->first();


        if ($check) {
            $check->delete();
            $user = Auth::user();
            $user->phone_verified_at = Carbon::now();
            $user->save();
            return redirect(url('/'))->with('success' , 'تم تفعيل رقم الموبيل بنجاح' );
        }

        Session::push('error' , 'كود التفعيل غير صحيح' );
        return redirect(route('site.verify_phone'));
    }

}
