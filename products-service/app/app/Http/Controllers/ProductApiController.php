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