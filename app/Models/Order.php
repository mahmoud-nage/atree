<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(OrderItem::class , 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class  , 'user_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function marketer_price()
    {
        $price = 0;
        foreach ($this->items as $item) {
            $price += $item->calculateMarketerMoney() ;
        }
        return $price;
    }


    public function status()
    {
        return $this->belongsTo(ShippingStatus::class, 'shipping_statues_id');
    }
}
