<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function user(){
         return $this->belongsTo(User::class);
    }

    public function taskable(){
            return $this->morphTo();
    }
}
