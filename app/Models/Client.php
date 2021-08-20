<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'vat_id', 'country_code', 'zip_code', 'city', 'address',
        'created_by', 'updated_by', 'deleted_by'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function setCountryCodeAttribute($value)
    {
        return strtoupper($value);
    }

    public function getFullAddressAttribute()
    {
        return $this->country_code.' '.$this->zip_code;
    }

}
