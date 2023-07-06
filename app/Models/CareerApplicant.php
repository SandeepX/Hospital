<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplicant extends Model
{
    use HasFactory;

    protected $table = 'career_applicants';

    protected $fillable = [
        'full_name',
        'career_master_id',
        'email',
        'contact_no',
        'cv',
        'cover_letter',
        'expected_salary',
        'note',
    ];

    const RECORDS_PER_PAGE = 10;

    const UPLOAD_PATH = 'uploads/career/applicants';

    public function careerMasterDetail()
    {
        return $this->belongsTo(CareerMasterDetail::class, 'career_master_id', 'id');
    }

    protected function note(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strip_tags($value),
        );
    }
}
