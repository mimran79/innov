<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'specification',
        'price',
        'image',
        'is_feature',
    ];

    // A product can have many variants (e.g., different colors/sizes)
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
