<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpensesCategory;
use Auth;
class ExpensesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['مياه'  , 'كهرباء'  , 'مرتبات' , 'اعلانات'  , 'مصاريف اخرى', 'مشتريات', 'عمولات', 'خسائر', 'هدر', 'نواقص' ];


        foreach ($categories as $category) {
            $ExpensesCategory = new ExpensesCategory;
            $ExpensesCategory->user_id = 1;
            $ExpensesCategory->name = $category;
            $ExpensesCategory->save();
        }
    }
}
