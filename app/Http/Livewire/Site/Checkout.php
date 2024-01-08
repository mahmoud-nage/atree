<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Cart;
use Auth;
class Checkout extends Component
{

    public $governorate_id;
    public $city_id;

    public function getGovernoratesProperty()
    {
        return Governorate::all();
    }

    public function getCitiesProperty()
    {
        return City::where('governorate_id' , $this->governorate_id )->get();
    }


    public function getShippingPriceProperty()
    {
        if ($this->city_id) {
            return City::find($this->city_id)?->shipping_cost ? City::find($this->city_id)?->shipping_cost : Governorate::find($this->governorate_id)?->shipping_cost;
        }

        if ($this->governorate_id) {
            return Governorate::find($this->governorate_id)?->shipping_cost;
        }
        return 0;
    }

    public function getMarketerBounseProperty()
    {
        $marketer_bounse = 0;
        $items = Cart::where('user_id' , Auth::id() )->get();
        foreach ($items as $item) {
           $marketer_bounse += $item->variation?->product->marketer_price + (($item->price - $item->variation?->product->getPrice()) * $item->quantity);
        }
        return  $marketer_bounse;
    }


    public function getSubTotalProperty()
    {
        $total = 0;
        $items = Cart::where('user_id' , Auth::id() )->get();
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
        $items = Cart::where('user_id' , Auth::id() )->get();
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->quantity * $item->product?->price );
        }
        return view('livewire.site.checkout' , compact('total' , 'items'  ) );
    }
}
