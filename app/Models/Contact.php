<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'email',
        'subject',
        'message',
        'status',
        'reply',
        'replied_at'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge badge-warning">Bekliyor</span>',
            'read' => '<span class="badge badge-info">Okundu</span>',
            'replied' => '<span class="badge badge-success">Yanıtlandı</span>',
            default => '<span class="badge badge-secondary">Bilinmiyor</span>',
        };
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    public function getSourceBadgeAttribute()
    {
        return $this->user_id 
            ? '<span class="badge badge-info">Kayıtlı Kullanıcı</span>'
            : '<span class="badge badge-secondary">Ziyaretçi</span>';
    }
}
