<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'user_id',
        'project_id',
        'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the task's deadline
     *
     * @return string
     */
    public function getDeadlineAttribute($value)
    {
        return date('m-d-Y', strtotime($value));
    }

    /**
     * Scope to exclude some status
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param $flag
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExcludeState($query, $flag)
    {
        return $query->where('status_id', '!=', $flag);
    }

    /**
     * Relation with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation with Project model
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relation with Status model
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
