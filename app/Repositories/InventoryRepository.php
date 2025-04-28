<?php

namespace App\Repositories;

use App\Models\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class InventoryRepository
{
    /**
     * Query all inventories collections.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return QueryBuilder::for(subject: Inventory::class)
            ->allowedFilters(filters: ['sku', 'name'])
            ->get();
    }

    /**
     * Quer a single inventory resource.
     *
     * @param string $id
     *
     * @return Inventory
     */
    public function get(string $id): Inventory
    {
        return QueryBuilder::for(subject: Inventory::class)
            ->findOrFail($id);
    }

    /**
     * Store a single inventory resource.
     *
     * @param array $validated
     *
     * @return mixed
     */
    public function create(array $validated): mixed
    {
        return DB::transaction(fn () => Inventory::query()->create(
            attributes: [
                ...$validated,
            ]
        ));
    }

    /**
     * Update a single inventory resource.
     *
     * @param string $id
     * @param array $validated
     *
     * @return bool
     */
    public function update(string $id, array $validated):bool
    {
        $inventory = $this->get($id);

        return DB::transaction(fn () => $inventory->update(
            [
                ...$validated,
            ]
        ));
    }

    /**
     * Delete a single inventory resource.
     *
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $inventory = $this->get($id);

        return DB::transaction(fn () => $inventory->delete());
    }
}