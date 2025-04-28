<?php

namespace Tests\Feature\Api\V1;

use App\Models\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_inventory_success()
    {
        Inventory::factory()->count(3)->create();

        $response = $this->getJson('/api/inventory');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['type', 'id', 'attributes', 'links']
                ]
            ]);
    }
}
