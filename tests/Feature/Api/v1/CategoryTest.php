<?php

namespace Tests\Feature\V1\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_categories_success()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/category');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['type', 'id', 'attributes', 'links']
                ]
            ]);
    }

    public function test_fetch_one_category_success()
    {
        $category = Category::factory()->create();

        $response = $this->getJson('/api/category/' . $category->id);

        $response->assertStatus(200)
            ->assertJson([
                'type' => 'category',
                'id' => $category->id,
                'attributes' => [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                ],
            ]);
    }

    public function test_store_one_category_success()
    {
        $data = [
            'name' => 'Test Category',
            'description' => 'Category description test.',
        ];

        $response = $this->postJson('/api/category', $data);

        $response->assertStatus(201)
            ->assertJson([
                'type' => 'category',
                'attributes' => [
                    'name' => 'Test Category',
                    'slug' => 'test-category',
                    'description' => 'Category description test.',
                ],
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'Category description test.',
        ]);
    }

    public function test_store_one_category_with_the_bad_request()
    {
        $data = [
            'name' => 123,
        ];

        $response = $this->postJson('/api/category', $data);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }

    public function test_update_one_category_success()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Test Category Update',
            'description' => 'Category update description.',
        ];

        $response = $this->putJson(
            uri: '/api/category/' . $category->id,
            data: $data
        );

        $response->assertStatus(200)
            ->assertJson([
                'type' => 'category',
                'attributes' => [
                    'name' => 'Test Category Update',
                    'slug' => 'test-category-update',
                    'description' => 'Category update description.',
                ],
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category Update',
            'slug' => 'test-category-update',
            'description' => 'Category update description.',
        ]);
    }

    public function test_delete_one_category_success()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(
            uri: '/api/category/' . $category->id,
        );

        $response->assertStatus(200)
            ->assertJson([
                'result' => 'ok',
                'message' => 'Category deleted!',
            ]);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
