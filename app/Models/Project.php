<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    
    public const PROJECT_STATUS = ['On hold', 'Inactive'] ;
    
    protected $table = 'projects';
    protected $fillable = ['title', 'description', 'start_date', 'budget', 'project_status', 'client_id', 'user_id'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    
    public function client()
    {
        return $this->BelongsTo(Client::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function startDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m-d-Y')
        );
    }
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
