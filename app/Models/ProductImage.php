<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'image_path',
        'sort_order'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
