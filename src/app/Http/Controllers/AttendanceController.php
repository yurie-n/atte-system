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
        return view('index');
    }

    public function store()
    {
        $dt = Carbon::parse('now');

        Attendance::create([
            'user_id' => Auth::user()->id,
            'work_date' => $dt->toDateString(),
            'work_started_at' => $dt->toTimeString(),
        ]);
        return view('index');
    }
    
    public function update()
    {
        $dt = Carbon::parse('now');
        $end_time = $dt->toTimeString();
        $id = Auth::user()->id;

        Attendance::whereUserId($id)->where('work_date', '=', $dt->toDateString())->first()->update(['work_ended_at' => $end_time]);
        return view('index');
    }
}
