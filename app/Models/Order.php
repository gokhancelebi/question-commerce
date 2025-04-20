<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * Order status constants
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * Available order statuses
     *
     * @var array<string, string>
     */
    public const STATUSES = [
        self::STATUS_PENDING => 'Bekliyor',
        self::STATUS_PROCESSING => 'İşleniyor',
        self::STATUS_COMPLETED => 'Tamamlandı',
        self::STATUS_CANCELLED => 'İptal Edildi',
    ];

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_name',
        'shipping_surname',
        'shipping_phone',
        'shipping_email',
        'shipping_code',
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
            self::STATUS_PENDING => '<span class="badge badge-warning">Bekliyor</span>',
            self::STATUS_PROCESSING => '<span class="badge badge-info">İşleniyor</span>',
            self::STATUS_COMPLETED => '<span class="badge badge-success">Tamamlandı</span>',
            self::STATUS_CANCELLED => '<span class="badge badge-danger">İptal Edildi</span>',
            default => '<span class="badge badge-secondary">Bilinmiyor</span>',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Bilinmiyor';
    }

    /**
     * Check if order is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if order is processing
     */
    public function isProcessing(): bool
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    /**
     * Check if order is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if order is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Update order status
     */
    public function updateStatus(string $status): self
    {
        if (!array_key_exists($status, self::STATUSES)) {
            throw new \InvalidArgumentException('Invalid order status');
        }

        $this->status = $status;
        $this->save();

        return $this;
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
