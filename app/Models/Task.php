<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'start_date', 'task_status', 'client_id'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    
    public function client()
    {
        return $this->BelongsTo(Client::class);
    }
}
