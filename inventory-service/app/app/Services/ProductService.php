<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected $client;

    public function __construct()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::retry(function(
            $retries,
            $request,
            $response = null,
            $exception = null
        ) {
            return $retries < 3 && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
        }));

        $this->client = new Client([
            'base_uri' => config('services.productos.url'),
            'timeout' => 5,
            'handler' => $stack,
            'headers' => [
                'X-API-KEY' => config('services.productos.key'),
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json',
            ]
        ]);
    }

    public function getProduct($id)
    {
        try {
            $response = $this->client->get("/api/v1/products/{$id}");
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Error fetching product: " . $e->getMessage());
            return null;
        }
    }
}