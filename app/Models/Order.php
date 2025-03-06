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
        'shipping_name',
        'shipping_surname',
        'shipping_phone',
        'shipping_email',
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

    /**
     * Fill shipping information from user's default shipping info
     */
    public function fillShippingFromUser(User $user): self
    {
        $this->fill($user->getDefaultShippingInfo());
        return $this;
    }

    /**
     * Add a product to the order
     */
    public function addItem(Product $product, int $quantity = 1): OrderItem
    {
        return $this->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price
        ]);
    }

    /**
     * Update order total amount based on items
     */
    public function updateTotal(): self
    {
        $this->total_amount = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $this->save();
        
        return $this;
    }

    /**
     * Get order items total
     */
    public function getItemsTotalAttribute(): float
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
}
