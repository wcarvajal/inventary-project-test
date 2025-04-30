<?php

namespace App\Http\Controllers;

use App\Models\Product;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class ProductApiController extends JsonApiController
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }
}

/**
 * @OA\Get(
 *     path="/api/v1/products",
 *     tags={"Products"},
 *     summary="List all products",
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/ProductCollection")
 *     )
 * )
 */