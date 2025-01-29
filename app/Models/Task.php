<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;


    public const STATUS = ['progress', 'ready', 'completed', 'canceled', 'estimated', 'todo'];
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'project_id',
        'deadline',
        'status'
    ];

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * project
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * createdAt
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('m/d/Y', strtotime($value))
        );
    }


    protected function deadline(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) =>  date('Y-m-d', strtotime($value))
        );
    }
}
