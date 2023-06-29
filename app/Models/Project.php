<?php

namespace App\Models;

use App\Enums\Project\ProjectStatusEnum;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, Filterable;

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
