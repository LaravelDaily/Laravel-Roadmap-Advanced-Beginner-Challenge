<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_company',
        'description_company',
        'vat_company',
        'zip_company',
        'address_company',
        'city_company',
        'name_manager',
        'email_manager',
        'phone_manager',
    ];
}
