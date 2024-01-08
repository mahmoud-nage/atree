<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Spatie\Translatable\HasTranslations;
class Brand extends Model
{
    use HasTranslations , HasFactory;
    public $translatable = ['name'];



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
        $this->active = isset($data['active']) ? 1 : 0;
        return $this->save();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
