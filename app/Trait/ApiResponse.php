<?php

namespace App\Trait;

use App\Http\Resources\PaginationResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    /**
     * @param string $message
     * @param mixed|null $data
     *
     * @return JsonResponse
     */
    private static function makeSuccess(int $code = Response::HTTP_OK, string $message = '', $data = [], bool $direct = true): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => !$direct ? [
                'list' => $data,
                'paginator' => PaginationResponse::make($data->response()->getData(true))
            ] : $data,
        ], $code);
    }

    /**
     * @param int $code
     * @param string $message
     * @param array|null $errors
     * @return JsonResponse
     */
    private static function makeError(int $code = Response::HTTP_BAD_REQUEST, string $message = '', ?array $errors = []): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
