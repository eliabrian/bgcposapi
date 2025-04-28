<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'inventory',
            'id' => $this->id,
            'attributes' => [
                'sku' => $this->sku,
                'name' => $this->name,
                'quantity' => $this->quantity,
                'unit' => $this->unit,
                'price' => $this->price,
                'stock' => $this->stock,
            ],
            'links' => [
                'self' => route('inventory.index')
            ],
        ];
    }
}
