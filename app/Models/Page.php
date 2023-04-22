<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'name',
        'slug',
        'title',
        'sub_title',
        'description_one',
        'description_two',
        'is_active',
    ];

    const RECORDS_PER_PAGE = 10;

}
