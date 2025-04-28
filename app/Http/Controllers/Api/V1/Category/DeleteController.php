<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    use Response;

    private CategoryRepository $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function __invoke(string $id)
    {
        try {
            $this->category->delete($id);

            return $this->success(
                data: [
                    'result' => 'ok',
                    'message' => 'Category deleted!',
                ],
            );
        } catch (\Exception $e) {
            return $this->error(
                exception: $e,
                message: 'Error when trying to delete a category.',
            );
        }
    }
}
