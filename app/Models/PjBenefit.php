<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjBenefit extends Model
{
    use HasFactory;

    protected $table = 'pj_benefit';
    protected $fillable = ['id','Nactivity', 'benefit'];
}
