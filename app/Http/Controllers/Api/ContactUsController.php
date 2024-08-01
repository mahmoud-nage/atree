<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Trait\ApiResponse;
use App\Http\Requests\Site\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ContactUsController extends Controller
{
    use ApiResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     * @return JsonResponse
     */
    public function store(ContactUsRequest $request)
    {
        Message::create($request->validated());
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
    }


}
