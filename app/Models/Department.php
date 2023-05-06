<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=['title'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
