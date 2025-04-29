<?php

namespace App\Http\Controllers\Api\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Inventory\InventoryResource;
use App\Repositories\InventoryRepository;
use App\Traits\Response;

class ShowController extends Controller
{
    use Response;

    private InventoryRepository $inventory;

    public function __construct(InventoryRepository $inventory)
    {
        $this->inventory = $inventory;
    }

    public function __invoke(string $id)
    {
        try {
            return $this->success(
                data: new InventoryResource($this->inventory->get($id))
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: "Error when fetching the inventory."
            );
        }
    }
}
