<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseGovernorate extends Model
{
    use HasFactory;
    protected $fillable = ['governorate_id', 'warehouse_id' , 'user_id' ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
