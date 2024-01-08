<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Auth;
class Unit extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    use HasFactory;


    public function conversions()
    {
        return $this->hasMany(UnitConversion::class , 'main_unit_id');
    }

    public function add($data)
    {
        $this->setTranslation('name' , 'ar' , $data['name']['ar']);
        $this->setTranslation('name' , 'en' , $data['name']['en']);
        $this->user_id = Auth::id();
        return $this->save();
    }

    public function edit($data)
    {
        $this->setTranslation('name' , 'ar' , $data['name']['ar']);
        $this->setTranslation('name' , 'en' , $data['name']['en']);
        return $this->save();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
