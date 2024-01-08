<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSegmentalPolicy extends Model
{
    use HasFactory;

    protected $fillable = ['product_id' , 'discount' , 'price' , 'percentage' , 'unit_id' , 'branch_id' ];
}
