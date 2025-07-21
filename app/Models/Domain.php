<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain',
        'name',
        'description',
        'is_active',
        'ssl_enabled',
        'ssl_certificate_path',
        'ssl_key_path',
        'custom_headers',
        'timeout',
        'enable_logging',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ssl_enabled' => 'boolean',
        'enable_logging' => 'boolean',
        'custom_headers' => 'array',
        'timeout' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function routingRules(): HasMany
    {
        return $this->hasMany(RoutingRule::class)->orderBy('priority', 'desc');
    }

    public function activeRoutingRules(): HasMany
    {
        return $this->routingRules()->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: $this->domain;
    }
}
