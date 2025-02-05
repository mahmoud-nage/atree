<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class  , 'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class  , 'order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class  , 'product_id');
    }
}
