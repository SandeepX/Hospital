<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HospitalService extends Model
{
    use HasFactory;

    protected $table = 'hospital_services';

    protected $fillable = [
        'name',
        'image',
        'start_date',
        'short_description',
        'description',
        'is_active',
        'is_quick_services',
        'png_class',
        'hospital_id',
        'created_by',
        'updated_by'
    ];

    const RECORDS_PER_PAGE = 10;

    const UPLOAD_PATH = 'uploads/service/';


    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function hospital()
    {
        return $this->belongsTo(User::class, 'hospital_id', 'id');
    }

//    protected function description(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => strip_tags($value),
//        );
//    }

}

