<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjMainTarget extends Model
{
    use HasFactory;
    protected $table = 'pj_maintarget';
    protected $fillable = ['id','Nactivity', 'result_main', 'goal_unit', 'goal_amount', 'performance_unit', 'performance_amount'];
}
