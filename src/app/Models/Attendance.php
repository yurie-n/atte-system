<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'work_started_at',
        'work_ended_at'
    ];

   public function attendance()
   {
       return $this->belongsTo(users::class);
   }
}
