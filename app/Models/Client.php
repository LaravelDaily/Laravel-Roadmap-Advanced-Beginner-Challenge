<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes, Search;
    public const STATUS = ['active', 'inactive'];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'status',
        'company_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected $casts = [
        'created_at' => 'date:m/d/Y', // option 1, not working
    ];
    protected $dates = [
        'created_at'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:m/d/Y',
        ];
    }
    public function scopeActive(Builder $query): void
    {
        $query->where('status','active');
    }
}
