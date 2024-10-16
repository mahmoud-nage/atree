<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Models\PhoneVerificationCode;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Display the password reset link request view.
     *
     * @return View
     */
    public function send(Request $request): View
    {
        $user = User::where('phone', $request->phone)->firstOrFail();
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        return view('auth.verify-code', compact('user'));
    }

    /**
     * Display the password reset link request view.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function check(Request $request)
    {
        $user = User::where('phone', $request->phone)->firstOrFail();
        $check = PhoneVerificationCode::where([
            ['code' , '=' , $request->code ] ,
            ['phone' , '=' , $request->phone ]
        ])->first();

        if (!$check) {
            return redirect()->back()->with('error' , 'هذا الكود غير صحيح اعد المحاوله' );
        }
        $check->delete();
        return view('auth.new-password', compact('user'));
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'exists:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::where('phone', $request->phone)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(route('login.form', compact('user')))->with('success' , 'تم تغيير كلمه المرور بنجاح' );
    }
}
