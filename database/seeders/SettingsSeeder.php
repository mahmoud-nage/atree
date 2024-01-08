<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Settings = new Settings;
        $Settings->setTranslation('address'  , 'ar' , 'العنوان' );
        $Settings->setTranslation('address'  , 'en' , 'address' );
        $Settings->setTranslation('about_us'  , 'ar' , 'اسم الموقع' );
        $Settings->setTranslation('about_us'  , 'en' , 'site name' );
        $Settings->email  = 'admin@souq-altgaar.com';
        $Settings->phone  = '01014340346';
        $Settings->logo  = '01014340346';
        $Settings->android_link  = '01014340346';
        $Settings->ios_link  = '01014340346';
        $Settings->save();
    }
}
