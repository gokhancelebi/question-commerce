<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMatch extends Model
{
    protected $fillable = [
        'product_id',
        'answer_combinations',
        'is_active'
    ];

    protected $casts = [
        'answer_combinations' => 'array',
        'is_active' => 'boolean'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
