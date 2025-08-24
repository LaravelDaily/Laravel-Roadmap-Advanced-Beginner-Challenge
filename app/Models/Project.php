<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['client_id', 'user_id', 'title', 'description', 'deadline', 'status'];

    public const STATUS = ['open', 'active', 'inactive', 'in progress', 'finished'];
    //create array constant in laravel controller

    //create scope for active only Tasks
    public function scopeActive( $query )
    {
        $query->withoutTrashed();
    }

    //accessor to change a display of a date instead of yyyy-mm-dd to mm-dd-yyyy
    public function getDeadlineAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['deadline'])->format('m-d-Y');
    }



    /**
     * Get all of the tasks for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the client that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the client that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
