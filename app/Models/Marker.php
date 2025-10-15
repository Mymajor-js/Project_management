<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasFactory;
    protected $table = 'markers';
    protected $fillable = [
        'latitude',
        'longitude',
        'province',
        'district',
        'subdistrict',
        'Nactivity',
        'mauban',
        'mautee',  
        'arear_money',
        'time_pj',
        'time_pj_end',
        'year_money',
        'description',
        'suggestions',
        'my_name',
        'status',
        'number_target',
        'number_target_out',
        'performancex',
        'project_id',
        'applied'
    ];
    public function number() {
        return $this->hasMany(Number::class, 'Nactivity', 'Nactivity');
    }

    public function activity() {
        return $this->hasMany(PjActivity::class, 'Nactivity', 'Nactivity');
    }

    public function benefit() {
        return $this->hasMany(PjBenefit::class, 'Nactivity', 'Nactivity');
    }

    public function maintarget() {
        return $this->hasMany(PjMaintarget::class, 'Nactivity', 'Nactivity');
    }

    public function person() {
        return $this->hasMany(PjPerson::class, 'Nactivity', 'Nactivity');
    }

    public function result() {
        return $this->hasMany(PjResult::class, 'Nactivity', 'Nactivity');
    }

    public function target() {
        return $this->hasMany(PjTarget::class, 'Nactivity', 'Nactivity');
    }
    
}
