<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class ShippingCompanies extends Model
{
    use HasTranslations;
    use HasFactory;
    public $translatable = ['name'];
}
