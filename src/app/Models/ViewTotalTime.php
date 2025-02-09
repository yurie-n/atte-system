<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewTotalTime extends Model
{
    use HasFactory;

    // Attendance, Restテーブルから取得するため
    // fillable項目なし
    // protected $fillable = [
    // ];
}
