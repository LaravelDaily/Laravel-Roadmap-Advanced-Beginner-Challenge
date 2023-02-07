<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function user(){
         return $this->belongsTo(User::class);
    }
    public function clients(){
            return $this->hasMany(Client::class);
    }

    public function task(){
            return $this->morphMany(Task::class, 'taskable');
    }
}
