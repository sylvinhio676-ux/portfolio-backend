<?php

use App\Helpers\ApiResponse;

if (!function_exists('apiResponse')) {
    /**
     * Helper pour ApiResponse
     *
     * @return ApiResponse
     */
    function apiResponse(): ApiResponse
    {
        return new ApiResponse();
    }
}

if (!function_exists('successResponse')) {
    /**
     * Réponse de succès rapide
     *
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    function successResponse($data = null, string $message = 'Operation successful'): JsonResponse
    {
        return ApiResponse::success($data, $message);
    }
}

if (!function_exists('errorResponse')) {
    /**
     * Réponse d'erreur rapide
     *
     * @param string $message
     * @param mixed $errors
     * @param int $statusCode
     * @return JsonResponse
     */
    function errorResponse(string $message = 'An error occurred', $errors = null, int $statusCode = 500): JsonResponse
    {
        return ApiResponse::error($message, $errors, $statusCode);
    }
}