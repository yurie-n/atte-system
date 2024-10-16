<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RestController extends Controller
{
    public function store()
    {
        $dt = Carbon::parse('now');
        $id = Auth::user()->id;
        $attendance_id = Attendance::where('user_id', '=', $id)->where('work_date', '=', $dt->toDateString())->whereNull('work_ended_at')
            ->pluck('id')->first();
        
        Rest::create([
            'attendance_id' => $attendance_id,
            'break_started_at' => $dt->toTimeString(),
        ]);
        return view('index');
    }

    public function update()
    {
        $dt = Carbon::parse('now');
        $end_time = $dt->toTimeString();
        $id = Auth::user()->id;
        $attendance_id = Attendance::where( 'user_id', '=', $id )->where('work_date', '=', $dt->toDateString())->whereNull('work_ended_at')
        ->pluck('id')->first();
        Rest::where( 'attendance_id', '=', $attendance_id )->whereNull('break_ended_at')->update(['break_ended_at' => $end_time]);
        return view('index');
    }
}
