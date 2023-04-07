<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'vat', 'adress'];

    //create scope for active only Tasks
    public function scopeActive($query)
    {
        $query->withoutTrashed();
    }

    /**
     * Get all of the projects for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }
}
