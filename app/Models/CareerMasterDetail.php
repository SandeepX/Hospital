<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CareerMasterDetail extends Model
{
    use HasFactory;

    protected $table = 'career_master_details';

    protected $fillable = [
        'title',
        'career_designation_id',
        'job_opening_date',
        'job_closing_date',
        'position_type',
        'openings',
        'image',
        'description',
        'address',
        'salary_offered',
        'status',
        'created_by',
        'updated_by'

    ];

    const RECORDS_PER_PAGE = 10;

    const UPLOAD_PATH = 'uploads/career/';

    const POSITION_TYPE = ['contract','temporary','permanent'];

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

    public function designation()
    {
        return $this->belongsTo(CareerDesignation::class, 'career_designation_id', 'id');
    }

}
