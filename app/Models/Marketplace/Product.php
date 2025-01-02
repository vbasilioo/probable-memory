<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_type_id',
        'price',
    ];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'product_type_id');
    }
}