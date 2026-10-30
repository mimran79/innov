<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'price',
    ];

    // An order item belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // An order item belongs to a product variant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
