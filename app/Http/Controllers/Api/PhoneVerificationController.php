<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\SendCodeRequest;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Models\User;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Models\PhoneVerificationCode;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class PhoneVerificationController extends Controller
{
    use ApiResponse;

    /**
     * @param SendCodeRequest $request
     * @return JsonResponse
     */
    public function sendCode(SendCodeRequest $request): JsonResponse
    {
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        return self::makeSuccess(Response::HTTP_OK, __('messages.success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SendCodeRequest $request
     * @return JsonResponse
     */
    public function checkCode(SendCodeRequest $request): JsonResponse
    {
        $check = PhoneVerificationCode::where([
            ['code' , '=' , $request->code ] ,
            ['phone' , '=' , $request->phone ]
        ])->first();
        $user = User::where('phone', $request->phone)->first();

        if ($check) {
            $check->delete();
            $user->phone_verified_at = Carbon::now();
            $user->save();
            return self::makeSuccess(Response::HTTP_OK, __('messages.success'));
        }
        return self::makeSuccess(Response::HTTP_BAD_REQUEST, __('messages.wrong'));
    }
}
