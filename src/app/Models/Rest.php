<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

        protected $fillable = [
        'attendance_id'
    ];

   public function Rest()
   {
       return $this->belongsTo(attendances::class);
   }
}
