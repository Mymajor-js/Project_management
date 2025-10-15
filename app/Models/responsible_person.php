<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class responsible_person extends Model
{
    use HasFactory;
    protected $table = 'responsible_person_pj';

    // กำหนดคอลัมน์ที่สามารถบันทึกข้อมูลได้
    protected $fillable = [
        'Nactivity',
        'name_pepo',
        'position'
    ];
}
