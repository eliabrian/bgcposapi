<?php

namespace App\Http\Controllers\Api\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Inventory\InventoryCollection;
use App\Repositories\InventoryRepository;
use App\Traits\Response;

class IndexController extends Controller
{
    use Response;

    private InventoryRepository $inventory;

    public function __construct(InventoryRepository $inventory)
    {
        $this->inventory = $inventory;
    }

    public function __invoke()
    {
        try {
            return $this->success(
                data: new InventoryCollection($this->inventory->all())
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: "Error when fetching all inventories.",
            );
        }
    }
}