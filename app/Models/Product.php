<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Spatie\Translatable\HasTranslations;
class Product extends Model
{


    use HasFactory;
    use HasTranslations;
    public $translatable = ['name' , 'description'  ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function variations()
    {
        return $this->hasMany(Variation::class , 'product_id');
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function url()
    {
        return route('products.show' , $this->id.'-'.$this->name );
    }
   


    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function getPrice()
    {
        if ($this->price_after_discount) {
            return $this->price_after_discount;
        }

        return $this->price;
    }


}
