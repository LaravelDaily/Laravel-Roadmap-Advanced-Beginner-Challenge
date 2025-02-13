<?php

namespace App\Models;

use com_exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'client_id',
        'deadline',
        'status'
    ];

    public const STATUS = ['open', 'in progress', 'blocked', 'cancelled', 'completed'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function scopeActive(Builder $query): void
    {
        $query->whereIn('status',['open','in progress']);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('m/d/Y', strtotime($value))
        );
    }
}
