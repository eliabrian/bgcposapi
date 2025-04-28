<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Repositories\CategoryRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    use Response;

    private CategoryRepository $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function __invoke(StoreCategoryRequest $request): JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'name',
                'slug',
                'description',
            ]);

            $created = $this->category->create(validated: $validated);

            return $this->success(
                data: new CategoryResource($created),
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
