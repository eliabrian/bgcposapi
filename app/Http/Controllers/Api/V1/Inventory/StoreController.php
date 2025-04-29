<?php

namespace App\Http\Controllers\Api\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreInventoryRequest;
use App\Http\Resources\Inventory\InventoryResource;
use App\Repositories\InventoryRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    use Response;

    private InventoryRepository $inventory;

    public function __construct(InventoryRepository $inventory)
    {
        $this->inventory = $inventory;
    }

    public function __invoke(StoreInventoryRequest $request): JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'sku',
                'name',
                'quantity',
                'unit',
                'price',
                'stock',
            ]);

            $created = $this->inventory->create(validated: $validated);

            return $this->success(
                data: new InventoryResource($created),
                status: JsonResponse::HTTP_CREATED,
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: 'Error when trying to store a category.',
            );
        }
    }
}
