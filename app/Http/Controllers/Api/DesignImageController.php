<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DesignImage;
use App\Models\ProductImage;
use App\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class DesignImageController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $images = DesignImage::whereUserId(auth()->id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->hasFile('image')) {
            ProductImage::create([
                'user_id' => auth()->id(),
                'image' => basename($request->file('image')->store('designs')),
            ]);
        }
        return self::makeSuccess(Response::HTTP_OK, __('messages.created_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DesignImage $designImage
     * @return JsonResponse
     */
    public function destroy(DesignImage $designImage): JsonResponse
    {
        if(File::exists($designImage->image)) {
            File::delete($designImage->image);
        }
        return self::makeSuccess(Response::HTTP_OK, __('messages.deleted_successfully'));
    }
}
