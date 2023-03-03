<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Client extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company', 'vat', 'description', 'status'];
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function task()
    {
        return $this->morphMany(Task::class, 'taskable');
    }

    public function scopeActive(Builder $query){
            $query->where('status', true);
    }
}
