<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DoctorPageSetting extends Model
{
    use HasFactory;

    protected $table = 'doctor_page_title_settings';

    public $timestamps = false;

    protected $fillable = [
        'intro',
        'time',
        'fix_appt',
        'qualification',
        'skill',
        'experience'
    ];


}
