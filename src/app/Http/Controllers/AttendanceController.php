<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        $prev_attendance = Attendance::where( 'user_id', '=', Auth::user()->id )
        ->where('work_date', '<', $today)
        ->get()
        ->last();

        return view('index');
    }

    public function store()
    {
        // 出勤処理
        $id = Auth::user()->id;
        $today = now()->format('Y-m-d');
        $prev_attendance = Attendance::where( 'user_id', '=', $id )
        ->get()
        ->last();

        if(!is_null($prev_attendance) && $prev_attendance->work_date == $today){
            // 本日分の打刻あり
            echo "本日の出勤は打刻済みです。";
        }
        else{
            // 前回の打刻が今日より前(出勤打刻なし)
            if(!is_null($prev_attendance) && is_null($prev_attendance->work_ended_at)){
                // かつ前回退勤未打刻の場合は23:59:59で退勤打刻
                Attendance::whereUserId($id)
                ->get()
                ->last()
                ->update(['work_ended_at' => '23:59:59']);
            }
            // 出勤打刻
            $dt = Carbon::parse('now');
            Attendance::create([
                'user_id' => Auth::user()->id,
                'work_date' => $dt->toDateString(),
                'work_started_at' => $dt->toTimeString(),
            ]);
        }
        return view('index');
    }
    
    public function update()
    {
        // 退勤処理
        $id = Auth::user()->id;
        $today = now()->format('Y-m-d');
        $prev_attendance = Attendance::where( 'user_id', '=', $id )
        ->get()
        ->last();

        if(!is_null($prev_attendance) && $prev_attendance->work_date == $today){
            // 本日分の打刻あり
            if(!is_null($prev_attendance) && is_null($prev_attendance->work_started_at)){
                // 出勤打刻がNULL
                echo "本日の出勤が未打刻です。";
            }
            else if(!is_null($prev_attendance) && !is_null($prev_attendance->work_ended_at)){
                // 本日の退勤打刻済み
                echo "本日の退勤は打刻済みです。";
            }
            else{
                // 退勤打刻
                $dt = Carbon::parse('now');
                Attendance::whereUserId($id)
                ->where('work_date', '=', $dt->toDateString())
                ->first()
                ->update(['work_ended_at' => $dt->toTimeString()]);
            }
        }
        else{
            // 前回の打刻が今日より前(出勤打刻なし)
            echo "本日の出勤が未打刻です。";
        }
        return view('index');
    }
}
