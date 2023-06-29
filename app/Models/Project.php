<?php

namespace App\Models;

use App\Enums\Project\ProjectStatusEnum;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, Filterable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
        'client_id',
    ];

    protected $casts = [
        'status' => ProjectStatusEnum::class
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
