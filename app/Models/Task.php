<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'start_date', 'task_status', 'client_id'];

    public function client()
    {
        return $this->BelongsTo(Client::class);
    }
}
