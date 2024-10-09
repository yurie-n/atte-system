<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'attendance_id',
        'work_date',
        'break_started_at',
        'break_ended_at'
    ];

   public function Rest()
   {
       return $this->belongsTo(attendances::class);
   }
}
