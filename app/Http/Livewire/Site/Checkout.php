<?php

namespace App\Http\Livewire\Site;

use App\Models\PaymentMethod;
use App\Models\UserAddress;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Cart;
use Auth;

class Checkout extends Component
{

    public $governorate_id;
//    public $city_id;
    public $address_id;
    public $payment_method_id;

    public function getGovernoratesProperty()
    {
        return Governorate::where('active', 1)->get();
    }

//    public function getCitiesProperty()
//    {
//        return City::where('governorate_id', $this->governorate_id)->get();
//    }

    public function getMethodsProperty()
    {
        return PaymentMethod::whereActive(1)->get();
    }

    public function getAddressesProperty()
    {
        return UserAddress::whereUserId(auth()->id())->get();
    }

    public function getShippingPriceProperty()
    {
        if ($this->address_id) {
            $address = UserAddress::find($this->address_id);
            return $address?->governorate?->shipping_cost ?? $address?->governorate?->shipping_cost;
        }
        return 0;
    }

    public function getVatProperty()
    {
        return ceil($this->sub_total - ($this->sub_total / 1.15));
    }


    public function getSubTotalProperty()
    {
        $total = 0;
        $items = Cart::where('user_id', Auth::id())->get();
        foreach ($items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }


    public function getTotalProperty()
    {
        return $this->sub_total + $this->shipping_price;
    }


    public function render()
    {
        $items = Cart::where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->quantity * $item->product?->price);
        }
        return view('livewire.site.checkout', compact('total', 'items'));
    }
}
