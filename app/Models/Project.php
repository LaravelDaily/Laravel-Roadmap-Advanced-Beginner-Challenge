<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;



class Project extends Model
{
    use HasFactory;

    protected $guarded = [];


//    protected $dateFormat = 'Y-m-d';
//   public static $status_options=['todo','cancled','in progress','on hold','Done'];

    public function projectMilestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


/** @return  \Illuminate\Database\Eloquent\Casts\Attribute
 * */
    // accessors and mutators
    protected function deadline(): Attribute
    {
        return Attribute::make(
            get:function (){
                    return Carbon::createFromFormat('Y-m-d',$this->attributes['deadline'])->format('m/d/Y');
                    } ,
                             );
    }
//scopes
public function scopeDone($query){
    return $query->where('status','Done');
}
    public function scopeInprogress($query){
        return $query->where('status','inprogress');
    }





}
