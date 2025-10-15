<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjPerson extends Model
{
    use HasFactory;
    protected $table = 'pj_person';
    protected $fillable = ['id','Nactivity', 'name_lastname', 'position'];
}
