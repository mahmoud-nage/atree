<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            [ 'فودافون كاش'  , 'Vodafon Cash' ] , 
            [ 'حساب بنكى' , 'Bank account'] , 
            [ 'تليم باليد' , 'cash on hand'] , 
        ];
        foreach ($methods as $method) {
            $PaymentMethod = new PaymentMethod;
            $PaymentMethod->setTranslation('name' , 'ar' , $method[0] );
            $PaymentMethod->setTranslation('name' , 'en' , $method[1] );
            $PaymentMethod->save();
        }
    }
}
