<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingStatus;
class ShippingStatuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statues = [
            ['قيد التنفيذ' , 'proccessing'] , 
            ['تم تاكيد الطلب'  , 'confirmed'] , 
            ['قيد الشحن' , 'on shpping'] , 
            ['قيد التوصيل' , 'on delivery'] , 
            ['تم الاستلام' , 'received'] , 
            ['تم الغاء الطلب بواستطه العميل' , 'canceled by client'] , 
            ['تم الغاء الطلب بواستطه الموقع' , 'canceled by site'] , 
            ['تم ارجاع الطلب' , 'returnd'] , 
        ];

        foreach ($statues as $statue) {
            $shipping_statues = new ShippingStatus;
            $shipping_statues->setTranslation('name' , 'ar' , $statue[0] );
            $shipping_statues->setTranslation('name' , 'en' , $statue[1] );
            $shipping_statues->save();
        }
    }
}
