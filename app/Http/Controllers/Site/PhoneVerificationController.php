<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\PhoneVerificationCode;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class PhoneVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'])
            ->post('http://api.yamamah.com/SendSMS', [
                "Username" => "0569111000",
                "Password" => "D3DEeP2uezZyrix",
                "Tagname" => "ARTEE",
                "RecepientNumber" => '+966557916239',
                "VariableList" => "",
                "ReplacementList" => "",
                "Message" => 'كود التفعل الخاص بك' . 1111,
                "SendDateTime" => 0,
                "EnableDR" => False
            ]);
        dd($response->body());
//        dispatch(new SendVerificationCodeToViaPhoneNumberJob(auth()->user()->phone));
        return view('site.verify_phone');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $check = PhoneVerificationCode::where([
            ['code' , '=' , $request->code ] ,
            ['phone' , '=' , auth()->user()->phone ]
        ])->first();
        if ($check) {
            $check->delete();
            $user = User::where('phone', auth()->user()->phone)->firstOrFail();
            $user->phone_verified_at = Carbon::now();
            $user->save();
            return redirect(url('/'))->with('success', __('messages.updated_successfully'));
        }
        return redirect(route('verify_phone.index'))->with('error', __('messages.invalid_code'));
    }

}
