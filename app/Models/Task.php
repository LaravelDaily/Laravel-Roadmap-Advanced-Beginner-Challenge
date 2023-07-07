<?php

namespace App\Models;

use App\Enums\Task\TaskStatusesEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'user_id',
        'client_id',
        'project_id',
    ];

    protected $casts = [
        'status' => TaskStatusesEnum::class
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getDateAsCarbonAttribute()
    {
        return Carbon::parse($this->created_at);
    }

    public function scopeOrderPriority()
    {
        return $this->select(['id', 'title', 'client_id', 'status', 'priority', 'created_at'])
            ->orderBy('priority', 'desc')
            ->latest();
    }
}
