<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Models\PhoneVerificationCode;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class PhoneVerificationController extends Controller
{
    use ApiResponse;
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
            return self::makeSuccess(Response::HTTP_OK, __('messages.success'));
        }
        return self::makeSuccess(Response::HTTP_OK, __('messages.wrong'));
    }

}
