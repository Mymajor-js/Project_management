<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjTarget extends Model
{
    use HasFactory;
    protected $table = 'pj_target';
    protected $fillable = ['id','Nactivity', 'target'];
}
