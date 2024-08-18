<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;


    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
    public function design()
    {
        return $this->belongsTo(UserDesign::class, 'design_id');
    }


    public function calculateMarketerMoney()
    {
        $money = ($this->variation?->product?->marketer_price * $this->quantity) + (($this->price - $this->variation->product->getPrice()) * $this->quantity) ;

        return $money;
    }
}
