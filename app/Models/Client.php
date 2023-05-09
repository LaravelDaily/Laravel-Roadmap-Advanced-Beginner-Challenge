<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use Notifiable, HasFactory, InteractsWithMedia;

    public const CLIENT_STATUS = ['Active', 'Inactive'] ;

    protected $table = 'clients';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'company', 'email', 'phone', 'country', 'client_status'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagesCRM');
    }
    
    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): void
    {
        $query->where('client_status', 'Active');
    }

       /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . " " . $this->last_name
        );
    }

}
