<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchWarehouse extends Model
{
    use HasFactory;

    public $fillable = ['branch_id' , 'warehouse_id'];


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
