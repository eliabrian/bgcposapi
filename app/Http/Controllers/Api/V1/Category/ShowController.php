<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Repositories\CategoryRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use Response;

    private CategoryRepository $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            return $this->success(
                data: new CategoryResource($this->category->get($id))
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: "Error when fetching the category.",
            );
        }
    }
}
