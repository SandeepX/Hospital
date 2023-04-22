<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $table = 'doctor_schedules';

    protected $fillable = [
        'doctor_id',
        'available_week_day',
        'is_active'
    ];

    const WEEKDAY = [
        0 => 'sunday',
        1 => 'monday',
        2 => 'tuesday',
        3 => 'wednesday',
        4 => 'thursday',
        5 => 'friday',
        6 => 'saturday',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($doctorScheduleDetail) {
            $doctorScheduleDetail->doctorTime()->delete();
        });
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function doctorTime(): HasMany
    {
        return $this->hasMany(DoctorScheduleTimeDetail::class, 'doctor_schedule_id', 'id')
            ->where('is_active',1);
    }

}
