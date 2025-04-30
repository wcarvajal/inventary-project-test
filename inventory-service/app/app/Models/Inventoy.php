<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['product_id', 'amount'];
    
    protected static function booted()
    {
        static::updated(function ($inventory) {
            logger()->info('Inventory Updated:', [
                'product_id' => $inventory->product_id,
                'new_amount' => $inventory->amount
            ]);
        });
    }
}