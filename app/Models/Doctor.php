<?php

namespace App\Models;

use App\Helpers\AppHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'full_name',
        'dob',
        'email',
        'avatar',
        'gender',
        'address',
        'phone_no',
        'dept_id',
        'speciality',
        'bio',
        'experience_in_year',
        'appointment_limit',
        'fb_link',
        'insta_link',
        'twitter_link',
        'position',
        'hospital_id',
        'is_active',
        'created_by',
        'updated_by'
    ];

    const RECORDS_PER_PAGE = 20;

    const UPLOAD_PATH = 'uploads/doctors/';

    const GENDER = ['male','female','others'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->hospital_id = AppHelper::getHospitalId() ?? 1;
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });

        static::deleting(function($doctorDetail) {
            $doctorDetail->academicDetails()->delete();
            $doctorDetail->scheduleDetails()->delete();
            $doctorDetail->skillDetails()->delete();
            $doctorDetail->workExperienceDetails()->delete();
        });
    }

    public function hospital()
    {
        return $this->belongsTo(HospitalProfile::class,'hospital_id','id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'id')->select('id','dept_name');
    }

    public function academicDetails(): HasMany
    {
        return $this->hasMany(DoctorAcademicQualification::class, 'doctor_id', 'id');
    }

    public function scheduleDetails(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id', 'id');
    }

    public function skillDetails(): HasMany
    {
        return $this->hasMany(DoctorSkill::class, 'doctor_id', 'id');
    }

    public function workExperienceDetails(): HasMany
    {
        return $this->hasMany(DoctorWorkExperience::class, 'doctor_id', 'id');
    }

    protected function bio(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strip_tags($value),
        );
    }

}
