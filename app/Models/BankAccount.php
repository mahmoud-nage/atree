<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class BankAccount extends Model
{
    use HasFactory;


    public function user() {

        return $this->belongsTo(User::class);
    }

    public function add($data)
    {
        $this->user_id = Auth::id();
        $this->name = $data['name'];
        $this->account_number = $data['account_number'];
        $this->iban = $data['iban'];
        $this->visa_fees = $data['visa_fees'];
        $this->mada_fees = $data['mada_fees'];
        return $this->save();
    }

    public function edit($data)
    {
        $this->name = $data['name'];
        $this->account_number = $data['account_number'];
        $this->iban = $data['iban'];
        $this->visa_fees = $data['visa_fees'];
        $this->mada_fees = $data['mada_fees'];
        return $this->save();
    }
}
