<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role',
        'default_shipping_name',
        'default_shipping_surname',
        'default_shipping_phone',
        'default_city',
        'default_district',
        'default_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get user's full name
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->surname}";
    }

    /**
     * Get default shipping information as array
     *
     * @return array<string, string|null>
     */
    public function getDefaultShippingInfo(): array
    {
        return [
            'shipping_name' => $this->default_shipping_name ?? $this->name,
            'shipping_surname' => $this->default_shipping_surname ?? $this->surname,
            'shipping_phone' => $this->default_shipping_phone ?? '',
            'shipping_email' => $this->email,
            'city' => $this->default_city ?? '',
            'district' => $this->default_district ?? '',
            'address' => $this->default_address ?? '',
        ];
    }

    /**
     * Check if user has default shipping information
     */
    public function hasDefaultShippingInfo(): bool
    {
        return !empty($this->default_shipping_name) &&
            !empty($this->default_shipping_surname) &&
            !empty($this->default_shipping_phone) &&
            !empty($this->default_city) &&
            !empty($this->default_district) &&
            !empty($this->default_address);
    }

    /**
     * Check if user is an admin
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }
}
