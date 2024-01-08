<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;



    public function warehouses()
    {
        return $this->hasMany(BranchWarehouse::class);
    }

    public function add($data)
    {
        $this->name = $data['name'];
        $this->phone1 = $data['phone1'];
        $this->address = $data['address'];
        $this->phone2 = $data['phone2'];
        $this->mobile = $data['mobile'];
        $this->fax = $data['fax'];
        $this->commercial_registration = $data['commercial_registration'];
        $this->show_phone1 = isset($data['show_phone1']) ? 1 : 0;
        $this->show_phone2 = isset($data['show_phone2']) ? 1 : 0;
        $this->show_mobile = isset($data['show_mobile']) ? 1 : 0;
        $this->show_address = isset($data['show_address']) ? 1 : 0;
        $this->show_fax = isset($data['show_fax']) ? 1 : 0;
        $this->show_commercial_registration = isset($data['show_commercial_registration']) ? 1 : 0;
        return $this->save();
    }

    public function edit($data)
    {
        $this->name = $data['name'];
        $this->phone1 = $data['phone1'];
        $this->address = $data['address'];
        $this->phone2 = $data['phone2'];
        $this->mobile = $data['mobile'];
        $this->fax = $data['fax'];
        $this->commercial_registration = $data['commercial_registration'];
        $this->show_phone1 = isset($data['show_phone1']) ? 1 : 0;
        $this->show_phone2 = isset($data['show_phone2']) ? 1 : 0;
        $this->show_mobile = isset($data['show_mobile']) ? 1 : 0;
        $this->show_address = isset($data['show_address']) ? 1 : 0;
        $this->show_fax = isset($data['show_fax']) ? 1 : 0;
        $this->show_commercial_registration = isset($data['show_commercial_registration']) ? 1 : 0;
        return $this->save();
    }
}
