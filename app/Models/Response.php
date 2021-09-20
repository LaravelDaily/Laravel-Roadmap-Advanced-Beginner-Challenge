<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Response extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'content',
        'task_id',
        'user_id',
    ];

    protected $with = [
        'user',
        'media',
    ];

    protected $imageSizes = [
        'thumb' => [300, 200],
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
