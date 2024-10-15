<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\ChangeStatusMail;
use AWS\CRT\Log;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ShippingStatus;
use App\Jobs\AddPointsToUserJob;
use App\Jobs\AddMoneyToUserIncomeJob;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.orders.index');
    }


    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Application|Factory|View
     */
    public function show(Order $order)
    {
        $statues = ShippingStatus::all();
        $order->load(['governorate', 'user', 'items', 'items.variation', 'status']);
        return view('dashboard.orders.show', compact('order', 'statues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $order->shipping_statues_id = $request->status_id;
        $order->save();
        $order->refresh();

        try {
            Mail::to($order->user->mail)->send(new ChangeStatusMail($order->load('status')));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('order change status', [$e->getMessage()]);
        }

        if ($request->status_id == 5) {
            foreach ($order->items as $order_item) {
                dispatch(new AddPointsToUserJob($order_item->variation_id, $order));
                dispatch(new AddMoneyToUserIncomeJob($order_item));
            }
        }
        return redirect()->back()->with('success', __('messages.changed_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
