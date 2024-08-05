<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RegisterRequest;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Models\User;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use function GuzzleHttp\Promise\all;

class RegisterController extends Controller
{
    use ApiResponse;

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        unset($validated['image']);
        unset($validated['password_confirmation']);
        unset($validated['password']);
        $user = User::create($validated + [
                'password' => Hash::make($request->password),
                'type' => User::USER,
                'name' => $request->first_name.' '.$request->last_name,
                'username' => substr(str_shuffle('abcdefghijklmnobqrstuvwxyz'), 0, 12)
            ]);
        if ($request->hasFile('image')) {
            $image = basename($request->file('image')->store('users'));
            $user->update(['image' => $image]);
        }
        Auth::login($user);
        $accessToken = \auth()->user()->createToken('mobile_app')->plainTextToken;
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        $data = [
            'token' => $accessToken
        ];
        return self::makeSuccess(Response::HTTP_OK, '', $data);
    }
}
