<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model
{
    use HasFactory;
    protected $fillable = ['product_id' , 'width_id' , 'quantity' , 'height_id' , 'high_id' , 'unit_id'];
}
