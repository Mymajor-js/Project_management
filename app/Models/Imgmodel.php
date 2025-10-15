<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imgmodel extends Model
{
    use HasFactory;
    protected $table = 'imgmodels';
    protected $fillable = [
        'latitude',
        'longitude',
        'Nactivity',
        'image_path'
    ];
}
