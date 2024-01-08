<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ShippingStatus;
use App\Jobs\AddPointsToUserJob;
use App\Jobs\AddMoneyToUserIncomeJob;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.orders.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $statues = ShippingStatus::all();
        $order->load(['governorate' , 'user' , 'items' , 'items.variation'  , 'status' ]);
        return view('dashboard.orders.show' , compact('order' , 'statues') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order )
    {
        $order->shipping_statues_id = $request->status_id;
        $order->save();

        if ($request->status_id == 5) {
            foreach ($order->items as $order_item) {
                dispatch(new AddPointsToUserJob($order_item->variation_id , $order ));
                dispatch(new AddMoneyToUserIncomeJob($order_item));
            }    
        }
        return redirect()->back()->with('success'  , 'تم التعديل بنجاح' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
