<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;
use App\Http\Controllers\DateTime;

class ListController extends Controller
{
    public function index()
    {
        session_start();
        // SESSION['start']が未設定なら現在時刻を設定し、
        // SESSION['start']から10800秒(パスワードタイムアウト)経過したらセッションを破棄
        if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 10800)) {
            session_unset(); 
            session_destroy(); 
            echo "session destroyed"; 
        }
        $_SESSION['start'] = time();

        // 初期表示の日付(今日)をセッション情報として保存
        $_SESSION['current_date'] = now();
        // セッション情報の取得
        $current_date = $_SESSION['current_date']->format('Y-m-d');
        //dd($_SESSION['current_date']);

        $attendance = DB::table('view_total_time as t')
            ->select('t.name','t.id')
            ->selectRaw('MIN(t.work_time) AS work_time')
            ->selectRaw('MIN(t.work_started_at) AS work_start_time')
            ->selectRaw('MAX(t.work_ended_at) AS work_end_time')
            ->selectRaw('sec_to_time(sum( time_to_sec(t.rest_time))) AS total_rest_time')
            ->where( 't.user_id', '=', Auth::user()->id )
            ->where( 't.work_date', '=', $current_date)
            ->groupBy('t.id')
            ->get();
        
        $worktimes = [];
        foreach ($attendance as $datas){
            $work_dt = Carbon::createFromTimeString($datas->work_time);
            $rest_dt = Carbon::createFromTimeString($datas->total_rest_time);

            // work_timeから休憩時間を引いた時分秒を取得
            $diff_hour = sprintf('%02d', $rest_dt->diffInHours($work_dt));
            $diff_minute = sprintf('%02d', $rest_dt->diffInMinutes($work_dt));
            $diff_second = sprintf('%02d', $rest_dt->diffInSeconds($work_dt));
            array_push($worktimes, $diff_hour.":".$diff_minute.":".$diff_second);
        }
        return view('list', compact('attendance','worktimes'));
    }

    public function get_prev()
    {
        session_start();
        // セッション情報を1日前の日付に更新
        $_SESSION['current_date'] = $_SESSION['current_date']->modify('-1 day');
        $current_date = $_SESSION['current_date']->format('Y-m-d');
        $data_list = $this->get_date_list($current_date);
        return view('list', $data_list);
    }

    public function get_next()
    {
        session_start();
        // セッション情報を1日後の日付に更新
        $_SESSION['current_date'] = $_SESSION['current_date']->modify('+1 day');
        $current_date = $_SESSION['current_date']->format('Y-m-d');
        $data_list = $this->get_date_list($current_date);
        return view('list', $data_list);
    }

    public function get_date_list($current_date){
        // 指定の日付の勤怠データを取得
        $attendance = DB::table('view_total_time as t')
            ->select('t.name','t.id')
            ->selectRaw('MIN(t.work_time) AS work_time')
            ->selectRaw('MIN(t.work_started_at) AS work_start_time')
            ->selectRaw('MAX(t.work_ended_at) AS work_end_time')
            ->selectRaw('sec_to_time(sum( time_to_sec(t.rest_time))) AS total_rest_time')
            ->where( 't.user_id', '=', Auth::user()->id )
            ->where( 't.work_date', '=', $current_date)
            ->groupBy('t.id')
            ->get();
        
        $worktimes = [];
        foreach ($attendance as $datas){
            $work_dt = Carbon::createFromTimeString($datas->work_time);
            $rest_dt = Carbon::createFromTimeString($datas->total_rest_time);

            // work_timeから休憩時間を引いた時分秒を取得
            $diff_hour = sprintf('%02d', $rest_dt->diffInHours($work_dt));
            $diff_minute = sprintf('%02d', $rest_dt->diffInMinutes($work_dt));
            $diff_second = sprintf('%02d', $rest_dt->diffInSeconds($work_dt));
            array_push($worktimes, $diff_hour.":".$diff_minute.":".$diff_second);
        }
        return compact('attendance','worktimes');
    }
}
