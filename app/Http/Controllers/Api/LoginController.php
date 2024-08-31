<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['phone' , 'password']);
        if (Auth::attempt($credentials, true)) {
            if(!auth()->user()->active){
                return self::makeError(Response::HTTP_BAD_REQUEST, __('site.user_not_found'));
            }
            $accessToken = \auth()->user()->createToken('mobile_app')->plainTextToken;
            $data = [
                'token' => $accessToken,
                'user' => AuthResource::make(auth()->user())
            ];
            return self::makeSuccess(Response::HTTP_OK, '', $data);
        }
        return self::makeError(Response::HTTP_BAD_REQUEST, __('site.credentials_not_corrent'));
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return self::makeSuccess(Response::HTTP_OK, __('messages.success'));
    }
}
