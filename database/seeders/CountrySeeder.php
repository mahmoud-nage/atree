<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Auth;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = new Country;
        $country->setTranslation('name' , 'ar' , 'مصر' );
        $country->setTranslation('name' , 'en' , 'Egypt' );
        $country->user_id = 1;
        $country->active = 1;
        $country->save();
    }
}
