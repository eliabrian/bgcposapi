<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository
{
    /**
     * Query all category collections.
     *
     * @return Paginator
     */
    public function all(): Paginator
    {
        return QueryBuilder::for(subject: Category::class)
            ->allowedFilters(filters: ['name'])
            ->paginate();
    }

    /**
     * Query a single category resource.
     *
     * @param string $id
     *
     * @return Category
     */
    public function get(string $id): Category
    {
        return QueryBuilder::for(subject: Category::class)
            ->findOrFail($id);
    }

    /**
     * Store a single category resource.
     *
     * @param array $validated
     *
     * @return mixed
     */
    public function create(array $validated): mixed
    {
        return DB::transaction(fn () => Category::query()->create(
            attributes: [
                ...$validated,
            ]
        ));
    }

    /**
     * Update a single category resource.
     *
     * @param string $id
     * @param array $validated
     *
     * @return bool
     */
    public function update(string $id, array $validated): bool
    {
        $category = $this->get($id);

        return DB::transaction(fn () => $category->update(
            [
                ...$validated,
            ]
        ));
    }


    /**
     * Delete a single category resource.
     *
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $category = $this->get($id);

        return DB::transaction(fn () => $category->delete());
    }
}
