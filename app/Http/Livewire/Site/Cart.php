<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Auth;
use App\Models\Cart as CartModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Cart extends Component
{
    use LivewireAlert;
    protected $listeners = ['cartChanged' => '$refresh' ];
    // protected $listeners = ['cartChanged' => '$refresh' ];

    public $subtotal;
    public $coupon;

    public function chackCoupon() {
        
    }
    public function getTotalProperty() {
        $total = 0;
        $items = CartModel::where('user_id' , Auth::id() )->get();
        foreach ($items as $item) {
            
            $total += $item->quantity * $item->price;
        }
        return $total;
    }


    public function getMarketerBounseProperty()
    {
        $marketer_bounse = 0;
        $items = CartModel::where('user_id' , Auth::id() )->get();
        foreach ($items as $item) {
           $marketer_bounse += $item->variation?->product->marketer_price + (($item->price - $item->variation?->product->getPrice()) * $item->quantity);
        }
        return  $marketer_bounse;
    }


    public function render()
    {
        $items = CartModel::where('user_id' , Auth::id() )->get();
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->quantity * $item->price );
        }

        return view('livewire.site.cart' , compact('items' , 'total'));
    }
}
