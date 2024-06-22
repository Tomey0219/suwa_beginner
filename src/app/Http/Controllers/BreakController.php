<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\BreakModel;

class BreakController extends Controller
{
    public function breakStart(){

        $user_id = Auth::user()->id;
        $attendance_record = Attendance::where('user_id',$user_id)->whereNull('work_endtime')->first();
        $attendance_id = $attendance_record->id;
        $breakStartTime = date("H:i:s");

        $create=[
            'attendance_id'=>$attendance_id,
            'break_starttime'=>$breakStartTime,
        ];

        BreakModel::create($create);

        return redirect('/');
    }

    public function breakEnd(){

        $user_id = Auth::user()->id;
        $attendance_record = Attendance::where('user_id',$user_id)->whereNull('work_endtime')->first();
        $attendance_id = $attendance_record->id;
        $breakEndTime = date("H:i:s");

        BreakModel::where('attendance_id',$attendance_id)->whereNull('break_endtime')->update(['break_endtime'=>$breakEndTime]);

        return redirect('/');
    }
}
