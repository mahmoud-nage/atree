<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Warehouse extends Model
{
    use HasFactory;



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function manger()
    {
        return $this->belongsTo(User::class , 'manger_id');
    }



    public function branches()
    {
        return $this->hasMany(BranchWarehouse::class);
    }



    public function add($data)
    {
        $this->user_id = Auth::id();
        $this->name = $data['name'];
        $this->manger_id = $data['manger_id'];
        return $this->save();
    }
    public function edit($data)
    {
        $this->name = $data['name'];
        $this->manger_id = $data['manger_id'];
        return $this->save();
    }


    public function governorates()
    {
        return $this->hasMany(WarehouseGovernorate::class );
    }
}
