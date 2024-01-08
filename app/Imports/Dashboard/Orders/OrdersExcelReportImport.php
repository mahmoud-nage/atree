<?php

namespace App\Imports\Dashboard\Orders;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Order;
use App\Jobs\AddPointsToUserJob;
use App\Jobs\AddMoneyToUserIncomeJob;
class OrdersExcelReportImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {   
            if ($row[0] == null ) {
                continue;
            } else {
                $order = Order::where('number' , $row[0])->first();
                if ($order) {
                    $order->shipping_statues_id = $row[1];
                    $order->save();
                    if ($row[1] == 5) {
                        foreach ($order->items as $order_item) {
                            dispatch(new AddPointsToUserJob($order_item->variation_id , $order ));
                            dispatch(new AddMoneyToUserIncomeJob($order_item->variation_id , $order ));
                        }    
                    }
                }

            }
        }
    }
}
