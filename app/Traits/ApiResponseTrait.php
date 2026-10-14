<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    protected function successResponse(
        mixed $data,
        string $message = 'Success',
        int $code = 200
    ): JsonResponse {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse(
        string $message,
        mixed $errors = null,
        int $code = 422
    ): JsonResponse {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}