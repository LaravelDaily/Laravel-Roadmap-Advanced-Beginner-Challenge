<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get:function (){
                return Carbon::createFromFormat('Y-m-d',$this->attributes['date'])->format('m/d/Y');
            }
        );

    }

//    private function date()
//    {
//        return Attribute::make(
//            get: date('m/d/y', strtotime($this->attributes['date'])),
//            set: function ($value) {
//                $date_parts = explode('/', $value);
//                $this->attributes['date'] = $date_parts[2] .'-'. $date_parts[0] . '-' . $date_parts[1];
//            }
//        );
//    }


}
