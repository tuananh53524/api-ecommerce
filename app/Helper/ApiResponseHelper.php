<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

Class ApiResponseHelper {
    public static function sendErrorResponse($message, $code = 400, $status=false, $errors = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
            'status' => $status
        ], $code);
    }

    public static function sendSuccessResponse($data, $code = 200, $status=true, $message = ''): JsonResponse
    {   
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}