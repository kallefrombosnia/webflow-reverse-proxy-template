<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutingRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'name',
        'description',
        'path_pattern',
        'target_url',
        'method',
        'priority',
        'is_active',
        'conditions',
        'headers',
        'load_balancing',
        'preserve_host',
        'timeout',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'preserve_host' => 'boolean',
        'conditions' => 'array',
        'headers' => 'array',
        'priority' => 'integer',
        'timeout' => 'integer',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForMethod($query, string $method)
    {
        return $query->where(function ($q) use ($method) {
            $q->where('method', $method)->orWhere('method', '*');
        });
    }

    public function matchesPath(string $path): bool
    {
        return preg_match('#^' . str_replace(['*', '/'], ['.*', '\/'], $this->path_pattern) . '$#', $path);
    }

    public function getFormattedTargetUrlAttribute(): string
    {
        return rtrim($this->target_url, '/');
    }
}
