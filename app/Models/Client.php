<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['company','vat','description','status'];
    public function projects(){
           return $this->belongsToMany(Project::class);
    }
    public function task(){
          return $this->morphMany(Task::class, 'taskable');
    }
}
