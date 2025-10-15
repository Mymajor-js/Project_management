<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjResult extends Model
{
    use HasFactory;
    protected $table = 'pj_result';
    protected $fillable = ['id','Nactivity', 'target'];
}
