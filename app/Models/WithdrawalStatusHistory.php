<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = ['withdrawal_id' , 'user_id' , 'status' ];
}
