<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;

class ListController extends Controller
{
    public function index()
    {
        $attendance = Attendance::all();

        return view('list', compact('attendance'));
    }
}
