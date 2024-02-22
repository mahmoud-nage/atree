<?php

namespace App\Http\Controllers\Site\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SurePayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param array $data
     * @return string
     */
    public function pay(array $data)
    {
        $data['application_id'] = '1858';
        $data['application_secret'] = 'QOR7OAZJQ8MSEoB8z4Ta';
        $data['due_date'] = date('d-m-Y');
        $data['expiry_date'] = 30;
        $data['expiry_hours'] = 0;
        $data['expiry_minutes'] = 0;
        $data['lang'] = app()->getLocale();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('https://sandbox-bills.surepay.sa/api/v1/bills/create', $data);
//        dd($response->body(),$data);
        if ($response->status() == 201) {
            return json_decode($response->body())->data ?? 0;
        }
        return 0;
    }

    public function callBack(Request $request): RedirectResponse
    {
        $order = Order::whereNumber($request->reference_id)->firstOrFail();
        if($request->status == 'success'){
            $order->whereNumber($request->reference_id)->update([
                'pay' => true,
                'payment_details' => $request->all(),
            ]);
            session()->flash('success', __('messages.added_successfully'));
            return redirect()->route('home');
        }
        session()->flash('success', __('messages.payment_fail'));
        return redirect()->route('checkout.pay', $order->number);
    }
}

?>
