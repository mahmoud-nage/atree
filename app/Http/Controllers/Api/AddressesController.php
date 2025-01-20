<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressesRequest;
use App\Http\Resources\AddressesResource;
use App\Http\Resources\LiteListResource;
use App\Models\Country;
use App\Models\UserAddress;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AddressesController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $records = UserAddress::whereUserId(auth()->id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', AddressesResource::collection($records));
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $countries = Country::where('active', 1)->with('governorates')->get();
        return self::makeSuccess(Response::HTTP_OK, '', LiteListResource::collection($countries));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressesRequest $request
     * @return JsonResponse
     */
    public function store(AddressesRequest $request): JsonResponse
    {
        $address = new UserAddress;
        $address->user_id = Auth::id();
        $address->governorate_id = $request->governorate_id;
        $address->country_id = $request->country_id;
        $address->building_number = $request->building_number;
        $address->street_name = $request->street_name;
        $address->district = $request->district;
        $address->save();
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
    }


    public function makeDefault($id): JsonResponse
    {
        UserAddress::where('user_id', Auth::id())->update([
            'is_default' => 0,
        ]);
        $address = UserAddress::find($id);
        if ($address) {
            $address->is_default = 1;
            $address->save();
        }
        return self::makeSuccess(Response::HTTP_OK, __('messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $address = UserAddress::find($id);
        $address->delete();
        return self::makeSuccess(Response::HTTP_OK, __('messages.deleted_successfully'));
    }
}
