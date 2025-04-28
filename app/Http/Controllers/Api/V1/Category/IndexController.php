<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Repositories\CategoryRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use Response;

    private CategoryRepository $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function __invoke(): JsonResponse
    {
        try {
            return $this->success(
                data: new CategoryCollection($this->category->all())
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: "Error when fetching all categories.",
            );
        }
    }
}
