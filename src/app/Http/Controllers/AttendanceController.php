<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use App\Models\BreakModel;

class AttendanceController extends Controller
{
    public function attInpDisp(){
        
        $user = Auth::user()->name;
        $user_id = Auth::user()->id;

        $input_status = Attendance::where('user_id',$user_id)->whereNull('work_endtime')->first();
        if(empty($input_status)){
            $break_status = null;
        }else{
            $attendance_id = $input_status->id;
            $break_status = BreakModel::where('attendance_id',$attendance_id)->whereNull('break_endtime')->first();
        }

        return view('index', compact('user','input_status','break_status'));
    }

    public function workStart(){
        
        $user_id = Auth::user()->id;
        $date = date("Y/m/d");
        $workStartTime = date("H:i:s");

        $create=[
            'user_id'=>$user_id,
            'date'=>$date,
            'work_starttime'=>$workStartTime,
        ];

        Attendance::create($create);

        return redirect('/');
    }

    public function workEnd(){
        
        $user_id = Auth::user()->id;
        $workEndTime = date("H:i:s");

        Attendance::where('user_id',$user_id)->whereNull('work_endtime')->update(['work_endtime'=>$workEndTime]);

        return redirect('/');
    }

    public function attTblDisp(Request $request){

        if($request->has('back_btn')){
            $current_date=$request->current_date;
            $date= date("Y-m-d",strtotime($current_date . '-1 day'));
        }elseif($request->has('next_btn')){
            $current_date=$request->current_date;
            $date= date("Y-m-d",strtotime($current_date . '+1 day'));
        }else{
            $date=date("Y-m-d");
        }

        $attendances = Attendance::with(['user','breaks'])->DateSearch($date)->paginate(5);

        $attendance_array=[];

        foreach($attendances as $attendance){

            $att_id = $attendance->id;

            // breaksテーブルのデータはコレクション型で返されるため、foreachで取り出し
            $breaktime_total = 0;
            foreach ($attendance->breaks as $break) {

                $breaks_att_id = $break->attendance_id;

            // 現在のattendanceIDに紐づく、breaksテーブルのデータのみを処理
                if($att_id==$breaks_att_id){
                    $break_starttime = $break->break_starttime;
                    $break_endtime = $break->break_endtime;

                // 1970年1月1日0時0分0秒からの時間
                    $starttime_sec=strtotime($break_starttime);
                    $endtime_sec=strtotime($break_endtime);
                    $breaktime_sec=$endtime_sec-$starttime_sec;

                    $breaktime_total += $breaktime_sec;

                }
            
            }

            // "HH:ii:ss"の形式に変換
                $hours = floor($breaktime_total / 3600);
                $minutes = floor($breaktime_total % 3600  / 60);
                $seconds = floor($breaktime_total % 60);

                $breaktime = sprintf("%02d:%02d:%02d",$hours,$minutes,$seconds);

            // 勤務時間計算

                $work_starttime=$attendance->work_starttime;
                $work_endtime=$attendance->work_endtime;

                $work_starttime_sec=strtotime($work_starttime);
                $work_endtime_sec=strtotime($work_endtime);
                $worktime_sec=$work_endtime_sec - $work_starttime_sec;

                // 休憩時間を除外
                $true_worktime_sec=$worktime_sec-$breaktime_total;

                $w_hours = floor($true_worktime_sec / 3600);
                $w_minutes = floor($true_worktime_sec % 3600  / 60);
                $w_seconds = floor($true_worktime_sec % 60);

                $worktime = sprintf("%02d:%02d:%02d",$w_hours,$w_minutes,$w_seconds);

            $each_attendance_array=[
                'name'=>$attendance->user->name,
                'starttime'=>$attendance->work_starttime,
                'endtime'=>$attendance->work_endtime,
                'breaktime'=>$breaktime,
                'worktime'=>$worktime
            ];

            array_push($attendance_array, $each_attendance_array);
        }

        return view('daily',compact('date','attendance_array','attendances'));
    }

    public function allUserDisp(){

        $users = User::all();
        
        return view('allUser',compact('users'));
    }

    public function eachUserDisp(Request $request){


        if($request->has('id')){
            $user_id=$request->id;
            $user_name=$request->name;
        }else{
            $user_id=$request->query('id');
            $user_name=$request->query('name');
        }

        $attendances = Attendance::with(['user','breaks'])->UserSearch($user_id)->paginate(5);

        $attendance_array=[];

        foreach($attendances as $attendance){

            $att_id = $attendance->id;

            // breaksテーブルのデータはコレクション型で返されるため、foreachで取り出し
            $breaktime_total = 0;
            foreach ($attendance->breaks as $break) {

                $breaks_att_id = $break->attendance_id;

            // 現在のattendanceIDに紐づく、breaksテーブルのデータのみを処理
                if($att_id==$breaks_att_id){
                    $break_starttime = $break->break_starttime;
                    $break_endtime = $break->break_endtime;

                // 1970年1月1日0時0分0秒からの時間
                    $starttime_sec=strtotime($break_starttime);
                    $endtime_sec=strtotime($break_endtime);
                    $breaktime_sec=$endtime_sec-$starttime_sec;

                    $breaktime_total += $breaktime_sec;

                }
            
            }

            // "HH:ii:ss"の形式に変換
                $hours = floor($breaktime_total / 3600);
                $minutes = floor($breaktime_total % 3600 / 60);
                $seconds = floor($breaktime_total % 60);

                $breaktime = sprintf("%02d:%02d:%02d",$hours,$minutes,$seconds);

            // 勤務時間計算

                $work_starttime=$attendance->work_starttime;
                $work_endtime=$attendance->work_endtime;

                $work_starttime_sec=strtotime($work_starttime);
                $work_endtime_sec=strtotime($work_endtime);
                $worktime_sec=$work_endtime_sec - $work_starttime_sec;

                // 休憩時間を除外
                $true_worktime_sec=$worktime_sec-$breaktime_total;

                $w_hours = floor($true_worktime_sec / 3600);
                $w_minutes = floor($true_worktime_sec % 3600 / 60);
                $w_seconds = floor($true_worktime_sec % 60);

                $worktime = sprintf("%02d:%02d:%02d",$w_hours,$w_minutes,$w_seconds);

            $each_attendance_array=[
                'date'=>$attendance->date,
                'starttime'=>$attendance->work_starttime,
                'endtime'=>$attendance->work_endtime,
                'breaktime'=>$breaktime,
                'worktime'=>$worktime
            ];

            array_push($attendance_array, $each_attendance_array);
        }

        return view('eachUser',compact('user_id','user_name','attendance_array','attendances'));
    }


}
