<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'result' => 'ok',
            'response' => 'collection',
            'data' => $this->collection,
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request $request
     * @param JsonResponse $response
     *
     * @return void
     */
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->header('Content-Type', 'application/json');
    }
}
