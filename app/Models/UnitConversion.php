<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    use HasFactory;
    protected $fillable = ['main_unit_id', 'unit_id' , 'factor'];



    public function unit()
    {
        return $this->belongsTo(Unit::class , 'unit_id');
    }
}
