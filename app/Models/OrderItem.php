<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }


    public function calculateMarketerMoney()
    {
        $money = ($this->variation?->product?->marketer_price * $item->quantity) + (($this->price - $this->variation->product->getPrice()) * $this->quantity) ;

        return $money;
    }
}
