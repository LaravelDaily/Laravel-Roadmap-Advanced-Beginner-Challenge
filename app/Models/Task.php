<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded=[];

    //relationships
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
//accessors and mutators

    protected function deadline(): Attribute
    {
        return Attribute::make(
            get:function (){
                return Carbon::createFromFormat('Y-m-d',$this->attributes['deadline'])->format('m/d/Y');
            } ,
        );
    }




//    private function deadline()
//    {
//        return Attribute::make(
//            get: date('m/d/y', strtotime($this->attributes['deadline'])),
//            set: function ($value) {
//                $date_parts = explode('/', $value);
//                $this->attributes['deadline'] = $date_parts[2] . '-' . $date_parts[0] . '-' . $date_parts[1];
//            }
//        );
//    }

}
