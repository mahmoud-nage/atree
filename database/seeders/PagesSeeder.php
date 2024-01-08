<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutUs = new Page();
        $aboutUs->setTranslation('title' , 'ar' , 'about-us' );
        $aboutUs->setTranslation('title' , 'en' , 'about-us' );
        $aboutUs->setTranslation('content' , 'ar' , 'about-us' );
        $aboutUs->setTranslation('content' , 'en' , 'about-us' );
        $aboutUs->user_id = 1;
        $aboutUs->slug = 'about-us';
        $aboutUs->active = 1;
        $aboutUs->save();
        $aboutUs = new Page();
        $aboutUs->setTranslation('title' , 'ar' , 'Privacy & Securty' );
        $aboutUs->setTranslation('title' , 'en' , 'Privacy & Securty' );
        $aboutUs->setTranslation('content' , 'ar' , 'Privacy & Securty' );
        $aboutUs->setTranslation('content' , 'en' , 'Privacy & Securty' );
        $aboutUs->user_id = 1;
        $aboutUs->slug = 'privacy-securty';
        $aboutUs->active = 1;
        $aboutUs->save();
        $aboutUs = new Page();
        $aboutUs->setTranslation('title' , 'ar' , 'Terms & Conditions' );
        $aboutUs->setTranslation('title' , 'en' , 'Terms & Conditions' );
        $aboutUs->setTranslation('content' , 'ar' , 'Terms & Conditions' );
        $aboutUs->setTranslation('content' , 'en' , 'Terms & Conditions' );
        $aboutUs->user_id = 1;
        $aboutUs->slug = 'terms-conditions';
        $aboutUs->active = 1;
        $aboutUs->save();
    }
}
