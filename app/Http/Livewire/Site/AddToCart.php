<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use Auth;
class AddToCart extends Component
{
    public $product;

    public function mount($product_id) {
        $this->product = Product::find($product_id);
    }

    public function add_to_cart() {
        if (!Auth::check()) {
            toastr()->error('يجب ان تكون عضوا لكى تضيف منتج الى السله');
        } else {
            $cart = Cart::where([
                ['product_id' , '=' , $this->product->id ] , 
                ['user_id' , '=' , Auth::id() ] , 
            ])->first();
            if ($cart) {
                $cart->quantity = $cart->quantity + 1;
                $cart->save();
            } else {
                $cart = new Cart;
                $cart->product_id = $this->product->id;
                $cart->user_id = Auth::id();
                $cart->quantity = 1;
                $cart->save();
            }
            toastr()->success('تم إضافه المنتج لسله بنجاح');
        }
    }

    public function render()
    {
        return view('livewire.site.add-to-cart');
    }
}
