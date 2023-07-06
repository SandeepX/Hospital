<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class HospitalProfile extends Model
{
    use HasFactory;

    protected $table = 'hospital_profiles';

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_one',
        'phone_two',
        'logo',
        'description',
        'marquee_content',
        'facebook_link',
        'insta_link',
        'twitter_link',
        'website_url',
        'location_lat',
        'location_long',
        'created_by',
        'updated_by'
    ];

    const RECORDS_PER_PAGE = 10;

    const UPLOAD_PATH = 'uploads/hospital/logo/';


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

    public function departments()
    {
        return $this->hasMany(Department::class,'hospital_id','id')->where('is_active',1);
    }

    public function packages()
    {
        return $this->hasMany(Package::class,'hospital_id','id')->where('is_active',1);
    }

}

