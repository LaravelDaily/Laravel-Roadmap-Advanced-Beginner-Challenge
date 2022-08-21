<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project(){
        return $this->hasMany(Projects::class);
    }

    public function task(){
        return $this->hasMany(Tasks::class);
    }
}
