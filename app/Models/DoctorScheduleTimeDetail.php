<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorScheduleTimeDetail extends Model
{
    use HasFactory;

    protected $table = 'doctor_schedule_time_details';

    public $timestamps = false;

    protected $fillable = [
        'doctor_schedule_id',
        'time_from',
        'time_to',
        'is_active'
    ];

    public function doctorSchedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id', 'id');
    }


}
