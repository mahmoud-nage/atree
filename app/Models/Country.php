<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Country extends Model
{

    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];



    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function governorates()
    {
        return $this->belongsTo(Governorate::class , 'country_id');
    }
}
