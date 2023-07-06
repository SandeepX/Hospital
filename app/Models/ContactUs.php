<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'location',
        'message',
        'is_seen'
    ];

    const RECORDS_PER_PAGE = 20;

    const GENDER = ['male','female','others'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->where('is_active',1);
    }

    protected function message(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strip_tags($value),
        );
    }
}

