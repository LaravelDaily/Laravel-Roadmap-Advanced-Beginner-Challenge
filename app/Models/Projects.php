<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Projects extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Clients::class);
    }

    public function task(){
        return $this->hasMany(Tasks::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopePorjectsWithStatus($query, $status){
        if($status == 'all'){
            return $query;
        }
        else{
            return $query->where('status', $status);
        }
    }

    protected function Deadline(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
        );
    }

    protected function CreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
        );
    }
}
