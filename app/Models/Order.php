<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'city',
        'district',
        'address'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge badge-warning">Bekliyor</span>',
            'processing' => '<span class="badge badge-info">İşleniyor</span>',
            'completed' => '<span class="badge badge-success">Tamamlandı</span>',
            'cancelled' => '<span class="badge badge-danger">İptal Edildi</span>',
            default => '<span class="badge badge-secondary">Bilinmiyor</span>',
        };
    }
}
