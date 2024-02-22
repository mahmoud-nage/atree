<?php

namespace App\Http\Livewire\Site;

use App\Models\Coupon;
use AWS\CRT\Log;
use Livewire\Component;
use Auth;
use App\Models\Cart as CartModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Cart extends Component
{
    use LivewireAlert;

    protected $listeners = ['cartChanged' => '$refresh'];

    public $subtotal;
    public $coupon;

    public function checkCoupon()
    {
        $coupon = Coupon::where('code', $this->coupon)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->where('allow_times', '>', 0)->first();
        if ($coupon) {
            return $coupon->discount;
        }
        return 0;
    }

    public function getDiscountProperty()
    {
        $coupon = Coupon::where('code', $this->coupon)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->where('allow_times', '>', 0)->first();
        if ($coupon) {
//            $coupon->decrement('allow_times');
            return $coupon->discount;
        }
        return 0;
    }

    public function getSubTotalProperty()
    {
        $total = 0;
        $items = CartModel::where('user_id', Auth::id())->get();
        foreach ($items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }

    public function getTotalProperty()
    {
        $total = 0;
        $items = CartModel::where('user_id', Auth::id())->get();
        foreach ($items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total - $this->discount;
    }


    public function getMarketerBounseProperty()
    {
        $marketer_bounse = 0;
        $items = CartModel::where('user_id', Auth::id())->get();
        foreach ($items as $item) {
            $marketer_bounse += $item->variation?->product->marketer_price + (($item->price - $item->variation?->product->getPrice()) * $item->quantity);
        }
        return $marketer_bounse;
    }


    public function render()
    {
        $items = CartModel::where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->quantity * $item->price);
        }

        return view('livewire.site.cart', compact('items', 'total'));
    }
}
