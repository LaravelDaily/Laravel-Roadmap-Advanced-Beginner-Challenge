<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    const PAGINATE = 20;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'client_id',
        'user_id',
        'status_id',
    ];

    protected $with = ['client', 'user'];

    public static $statuses = [
        '1' => 'Created',
        '2' => 'Working',
        '3' => 'Paused',
        '4' => 'Pending validation',
        '5' => 'Finished',
    ];

    protected $imageSizes = [
        'thumb' => [300, 200],
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function scopeFilterByStatus($query)
    {
        if (request()->has('status_id')) {
            request()->validate([
                'status_id' => [
                    'numeric',
                    Rule::in(collect(self::$statuses)->keys()->prepend(0)),
                ],
            ]);
            if (request('status_id') != 0) {
                return $query->where('status_id', request()->input('status_id'));
            }
        }

        return $query;
    }

    public function scopeFilterAssignedToUser($query)
    {
        if (request()->has('assigned_to_user')) {
            request()->validate(['assigned_to_user' => 'boolean']);
            if (request('assigned_to_user')) {
                return $query->where('user_id', auth()->id());
            }
        }

        return $query;
    }

    public function getDeadlineInvertedAttribute()
    {
        return Carbon::parse($this->deadline)->format('d/m/Y');
    }

    public function getStatusAttribute()
    {
        return self::$statuses[$this->status_id];
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::parse($updated_at)->format('d/m/Y H:i:s');
    }

    public function getDeletedAtAttribute($deleted_at)
    {
        return Carbon::parse($deleted_at)->format('d/m/Y H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        foreach ($this->imageSizes as $name => $dimensions) {
            $this->addMediaConversion($name)
                 ->width($dimensions[0])
                 ->height($dimensions[1])
                 ->sharpen(10);
        }
    }
}
