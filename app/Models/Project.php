<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','deadline','user_id','status'];
    public function user(){
         return $this->belongsTo(User::class);
    }
    public function clients(){
            return $this->belongsToMany(Client::class);
    }

    public function task(){
            return $this->morphMany(Task::class, 'taskable');
    }
}
