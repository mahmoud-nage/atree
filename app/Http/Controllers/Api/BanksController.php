<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BanksRequest;
use App\Http\Resources\AddressesResource;
use App\Models\BankAccount;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BanksController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $records = BankAccount::whereUserId(auth()->id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', AddressesResource::collection($records));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BanksRequest $request
     * @return JsonResponse
     */
    public function store(BanksRequest $request): JsonResponse
    {
        $address = new BankAccount;
        $address->add($request->validated());
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $address = BankAccount::find($id);
        $address->delete();
        return self::makeSuccess(Response::HTTP_OK, __('messages.deleted_successfully'));
    }
}
