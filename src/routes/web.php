<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\ListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'index']);
    Route::post('/attendance', [AttendanceController::class, 'store']);
    Route::patch('/attendance/update', [AttendanceController::class, 'update']);
    
    Route::post('/rest', [RestController::class, 'store']);
    Route::patch('/rest/update', [RestController::class, 'update']);

    Route::get('/list', [ListController::class, 'index']);
    Route::get('/list/prev', [ListController::class, 'get_prev']);
    Route::get('/list/next', [ListController::class, 'get_next']);
});

