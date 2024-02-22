<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

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
            [ 'كاش' , 'cash'] ,
            [ 'حساب بنكى' , 'Bank'] ,
//            [ 'فودافون كاش'  , 'Vodafon Cash' ] ,
        ];
        DB::table('payment_methods')->truncate();
        foreach ($methods as $method) {
            $PaymentMethod = new PaymentMethod;
            $PaymentMethod->setTranslation('name' , 'ar' , $method[0] );
            $PaymentMethod->setTranslation('name' , 'en' , $method[1] );
            $PaymentMethod->save();
        }
    }
}
