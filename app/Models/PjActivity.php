<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjActivity extends Model
{
    use HasFactory;
    protected $table = 'pj_activity';
    protected $fillable = ['id','Nactivity', 'name_activity', 'person_pj', 'resultx'];
}
