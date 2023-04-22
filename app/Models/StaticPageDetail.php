<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StaticPageDetail extends Model
{
    use HasFactory;

    protected $table = 'static_page_details';

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'description',
        'is_active',
        'page_id',
        'hospital_id',
        'created_by',
        'updated_by'

    ];

    const RECORDS_PER_PAGE = 10;

    const UPLOAD_PATH = 'uploads/static-page/';


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

    public function hospital()
    {
        return $this->belongsTo(User::class, 'hospital_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

}
