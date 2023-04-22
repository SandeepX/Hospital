<?php

namespace App\Models;

use App\Helpers\AppHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'patients_name',
        'contact_no',
        'email',
        'gender',
        'age',
        'dept_id',
        'doctor_id',
        'appointment_time_id',
        'appointment_date',
        'note',
        'reason',
        'status',
        'hospital_id',
        'updated_by',
    ];

    const RECORDS_PER_PAGE = 20;

    const STATUS = ['pending','accepted','rejected'];
    const GENDER = ['male','female','others'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->hospital_id = AppHelper::getHospitalId() ?? 1;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }

    public function hospital()
    {
        return $this->belongsTo(HospitalProfile::class,'hospital_id','id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dept_id', 'id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function appointmentTime(): BelongsTo
    {
        return $this->belongsTo(DoctorScheduleTimeDetail::class, 'appointment_time_id', 'id');
    }

    protected function note(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strip_tags($value),
        );
    }

    protected function reason(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strip_tags($value),
        );
    }
}
