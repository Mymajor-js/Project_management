<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mygroup_selector extends Model
{
    use HasFactory;

    protected $table = 'detail_activity';

    // กำหนดคอลัมน์ที่สามารถบันทึกข้อมูลได้
    protected $fillable = [
        'Nactivity',
        'detail_activity',
        'detail_x',
        'resultx'
    ];
}
