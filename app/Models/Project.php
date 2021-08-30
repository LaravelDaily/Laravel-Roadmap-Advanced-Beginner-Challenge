<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Project extends Model
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
        'client_id',
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
     * Get the project's deadline
     *
     * @return string
     */
    public function getDeadlineAttribute($value)
    {
        return date('m-d-Y', strtotime($value));
    }

    /**
     * Scope a query to only include projects of specific status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param $flag
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeState($query, $flag)
    {
        return $query->where('status_id', '=', $flag);
    }

    /**
     * Scope a query to exclude projects of specific status.
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
     * Relation with Client model
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation with Status model
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Relation with Task model
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
