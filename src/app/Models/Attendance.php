<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
        
    protected $fillable=[
            'user_id',
            'date',
            'work_starttime',
            'work_endtime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function breaks(){
        return $this->hasmany(BreakModel::class, 'attendance_id');
    }

    public function scopeDateSearch($query,$date){
        if(!empty($date)){
            $query->where('date', $date);
        }
    }

    public function scopeUserSearch($query,$user_id){
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }
    }

        
}
