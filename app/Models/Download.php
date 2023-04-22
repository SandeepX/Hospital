<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $table='downloads';

    protected $fillable = [
      'title',
      'file',
      'is_active',
    ];

    const RECORDS_PER_PAGE = 10;

    const UPLOAD_PATH = 'uploads/download/';


}
