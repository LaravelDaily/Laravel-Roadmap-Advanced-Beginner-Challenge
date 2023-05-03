<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = ['first_name', 'last_name', 'company', 'email', 'phone', 'country', 'client_status'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
