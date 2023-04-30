<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $table = 'projects';
    protected $fillable = ['title', 'description', 'start_date', 'budget', 'project_status', 'client_id'];

    public function client()
    {
        return $this->BelongsTo(Client::class);
    }
}
