<?php
namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_product()
    {
        $response = $this->postJson('/api/products', [
            'data' => [
                'type' => 'products',
                'attributes' => [
                    'name' => 'Test Product',
                    'price' => 19.99
                ]
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'attributes']
            ]);
    }

    public function test_can_list_products()
    {
        Product::factory()->count(5)->create();
        
        $response = $this->getJson('/api/products');
        
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }
}