<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Auth;
class Page extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title' , 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function add($data)
    {
        $this->setTranslation('title' , 'ar'  , $data['title']['ar']);
        $this->setTranslation('title' , 'en'  , $data['title']['en']);
        $this->setTranslation('content' , 'ar'  , $data['content']['ar']);
        $this->setTranslation('content' , 'en'  , $data['content']['en']);
        $this->slug = $data['slug'];
        $this->user_id = Auth::id();
        return $this->save();
    }

    public function edit($data)
    {
        $this->setTranslation('title' , 'ar'  , $data['title']['ar']);
        $this->setTranslation('title' , 'en'  , $data['title']['en']);
        $this->setTranslation('content' , 'ar'  , $data['content']['ar']);
        $this->setTranslation('content' , 'en'  , $data['content']['en']);
        $this->slug = $data['slug'];
        
        $this->active = isset($data['active']) ? 1 : 0 ;
        return $this->save();
    }

}
