<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'details' => 'json',
        'details_back' => 'json'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function design()
    {
        return $this->belongsTo(UserDesign::class, 'design_id');
    }
}
