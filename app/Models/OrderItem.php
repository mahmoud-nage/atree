<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $casts = [
        'details' => 'json',
        'details_back' => 'json'

    ];
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
        return (($this->variation?->product?->diamonds * $this->quantity) / 100) *  Settings::first()->point_equal_money;
    }
}
