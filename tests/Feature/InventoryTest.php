<?php

namespace Tests\Feature;

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

    public function test_fetch_one_inventory_success()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->getJson('/api/inventory/' . $inventory->id);

        $response->assertStatus(200)
            ->assertJson([
                'type' => 'inventory',
                'id' => $inventory->id,
                'attributes' => [
                    'sku' => $inventory->sku,
                    'name' => $inventory->name,
                    'quantity' => $inventory->quantity,
                    'unit' => $inventory->unit,
                    'price' => $inventory->price,
                    'stock' => $inventory->stock,
                ],
            ]);
    }

    public function test_store_one_inventory_success()
    {
        $data = [
           'sku' => 'ABC-12345-S-BL',
           'name' => 'Test Product',
           'quantity' => 2,
           'unit' => 'gram',
           'price' => 200.99,
           'stock' =>  3,
        ];

        $response = $this->postJson('/api/inventory', $data);

        $response->assertStatus(201)
            ->assertJson([
                'type' => 'inventory',
                'attributes' => [
                    'sku' => 'ABC-12345-S-BL',
                    'name' => 'Test Product',
                    'quantity' => 2,
                    'unit' => 'gram',
                    'price' => 200.99,
                    'stock' =>  3,
                ]
            ]);

        $this->assertDatabaseHas('inventories', [
            'sku' => 'ABC-12345-S-BL',
            'name' => 'Test Product',
        ]);
    }
}
