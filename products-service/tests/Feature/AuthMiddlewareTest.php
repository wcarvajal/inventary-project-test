<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthMiddlewareTest extends TestCase
{
    public function test_blocks_unauthorized_requests()
    {
        $response = $this->getJson('/api/products');
        $response->assertStatus(401);
    }

    public function test_allows_authorized_requests()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => config('services.api_key')
        ])->getJson('/api/products');
        
        $response->assertStatus(200);
    }
}