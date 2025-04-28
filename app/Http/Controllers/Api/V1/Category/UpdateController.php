<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Repositories\CategoryRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    use Response;

    private CategoryRepository $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function __invoke(string $id, UpdateCategoryRequest $request): JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'name',
                'slug',
                'description',
            ]);

            $this->category->update(
                id: $id,
                validated: $validated
            );

            return $this->success(
                data: new CategoryResource($this->category->get($id)),
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: 'Error when trying to update a category.'
            );
        }
    }
}
