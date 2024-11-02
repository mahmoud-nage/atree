<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVerificationCode extends Model
{
    protected $table = 'phone_verification_codes';
    use HasFactory;
    protected $guarded = [];
}
