<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait Response
{
    /**
     * Generate a successful response.
     *
     * @param array|JsonResource|ResourceCollection $data
     * @param int $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function success(array|JsonResource|ResourceCollection $data, int $status = JsonResponse::HTTP_OK, array $headers = []): JsonResponse
    {
        return response()->json(
            data: $data,
            status: $status,
            headers: $headers,
        );
    }

    /**
     * Generate a successful response.
     *
     * @param Exception $exception
     * @param string $message
     * @param int $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function error(Exception $exception, string $message, int $status = JsonResponse::HTTP_BAD_REQUEST, array $headers = []): JsonResponse
    {
        if (!empty($exception) && config('app.debug')) {
            $response['debug'] = [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ];
        }

        $response['message'] = $message;

        return response()->json(
            data: $response,
            status: $status,
            headers: $headers
        );
    }
}
