<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
    {
        $response = $this->postJson('/api/v1/products', [
            'data' => [
                'type' => 'products',
                'attributes' => [
                    'name' => 'Test Product',
                    'price' => 19.99
                ]
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonApiResource([
                'type' => 'products',
                'attributes' => [
                    'name' => 'Test Product',
                    'price' => 19.99
                ]
            ]);
    }
    
    public function test_product_not_found()
    {
        $response = $this->getJson('/api/v1/products/999');
        $response->assertJsonApiError(
            title: 'Not Found',
            detail: 'Resource not found',
            status: '404'
        );
    }
}