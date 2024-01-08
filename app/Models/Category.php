<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Auth;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
class Category extends Model
{
    use HasTranslations;
    use HasRecursiveRelationships;

    public $translatable = ['name'];
    use HasFactory;

    public function getParentKeyName()
    {
        return 'category_id';
    }
    

    public function add($data)
    {
        $this->setTranslation('name' , 'ar' , $data['name']['ar']);
        $this->setTranslation('name' , 'en' , $data['name']['en']);
        $this->user_id = Auth::id();
        $this->category_id = $data['category_id'];
        $this->show_in_header = isset($data['show_in_header']) ? 1 : 0 ;
        $this->show_in_home_page = isset($data['show_in_home_page']) ? 1 : 0 ;
        $this->show_after_slider = isset($data['show_after_slider']) ? 1 : 0 ;
        $this->active = isset($data['active']) ? 1 : 0 ;
        return $this->save();
    }

    public function edit($data)
    {
        $this->setTranslation('name' , 'ar' , $data['name']['ar']);
        $this->setTranslation('name' , 'en' , $data['name']['en']);
        $this->category_id = $data['category_id'];
        $this->show_in_header = isset($data['show_in_header']) ? 1 : 0 ;
        $this->show_in_home_page = isset($data['show_in_home_page']) ? 1 : 0 ;
        $this->show_after_slider = isset($data['show_after_slider']) ? 1 : 0 ;
        $this->active = isset($data['active']) ? 1 : 0 ;
        
        return $this->save();
    }

    public function products()
    {
        return $this->hasMany(Product::class , 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
