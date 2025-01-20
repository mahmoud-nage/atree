<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\ChangePhoneRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\DesignsResource;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Models\Order;
use App\Models\Follower;
use App\Models\User;
use App\Models\UserDesign;
use App\Models\Wishlist;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return self::makeSuccess(Response::HTTP_OK, '', AuthResource::make(auth()->user()));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function updateProfile(UpdateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $data['username'] = trim(str_replace(' ', '', $request->username));
        if ($request->hasFile('image')) {
            $data['image'] = basename($request->image->store('users'));
        }
        if ($request->hasFile('banner')) {
            $data['banner'] = basename($request->banner->store('users'));
        }
        $user->update($data);
        return self::makeSuccess(Response::HTTP_OK, __('messages.updated_successfully'), AuthResource::make(\auth()->user()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update(['password' => Hash::make($data['password'])]);
            return self::makeSuccess(Response::HTTP_OK, __('messages.updated_successfully'));
        }
        return self::makeError(Response::HTTP_BAD_REQUEST, __('site.wrong_old_password'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChangePhoneRequest $request
     * @return JsonResponse
     */
    public function changePhone(ChangePhoneRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        if ($data['phone'] != $user->phone) {
            $user->update(['phone' => $data['phone'], 'phone_verified_at' => null]);
            dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
            return self::makeSuccess(Response::HTTP_OK, __('messages.updated_successfully'));
        }
        return self::makeError(Response::HTTP_BAD_REQUEST, __('site.same_phone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('phone', $request->phone)->first();
        $user->update(['password' => Hash::make($data['password'])]);
        return self::makeSuccess(Response::HTTP_OK, __('messages.updated_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function deleteAccount(): JsonResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $user->update(['active' => 0]);
        return self::makeSuccess(Response::HTTP_OK, __('messages.deleted_successfully'));
    }

    public function wishlist()
    {
        $records = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records);
    }

    public function storeAndDeleteWishlist($id): JsonResponse
    {
        $record = Wishlist::where([
            ['user_id', '=', Auth::id()],
            ['product_id', '=', $id],
        ])->first();
        if ($record) {
            $record->delete();
            return self::makeSuccess(Response::HTTP_OK, __('messages.deleted_successfully'));
        }
        $record = Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
    }


    public function followers(): JsonResponse
    {
        $records = Follower::with('user')->where('designer_id', '=', Auth::id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records);
    }

    public function storeAndDeleteFollowers($id): JsonResponse
    {
        $record = Follower::where([
            ['user_id', '=', Auth::id()],
            ['designer_id', '=', $id],
        ])->first();
        if ($record) {
            $record->delete();
            return self::makeSuccess(Response::HTTP_OK, __('site.UnFollowed Successfully'));
        }
        $record = Follower::create([
            'user_id' => Auth::id(),
            'designer_id' => $id,
        ]);
        return self::makeSuccess(Response::HTTP_OK, __('messages.Followed Successfully'));
    }

    public function my_designs()
    {
        $records = UserDesign::where('user_id', '=', Auth::id())->with('products', 'user')->get();
        return self::makeSuccess(Response::HTTP_OK, '', DesignsResource::collection($records));
    }

    public function orders(): JsonResponse
    {
        $records = Order::where('user_id', auth()->id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records);
    }

    public function track_order($order_id)
    {
        $record = Order::findOrFail($order_id);
        return self::makeSuccess(Response::HTTP_OK, '', $record, false);
    }
}
