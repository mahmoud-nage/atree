<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Trait\ApiResponse;
use App\Http\Requests\Site\StoreMessageRequest;
use App\Models\Message;
use Symfony\Component\HttpFoundation\Response;

class ContactUsController extends Controller
{
    use ApiResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMessageRequest $request)
    {
        Message::create($request->validated());
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
    }


}
