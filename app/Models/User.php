<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    const PAGINATE = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->hasRole('admin');
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
}
