<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'start_date', 'task_status', 'client_id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagesCRM');
    }
    
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    
    public function client()
    {
        return $this->BelongsTo(Client::class);
    }
}
