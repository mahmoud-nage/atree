<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Product;
use Auth;
class AddToWishlist extends Component
{
    public $product;

    public function mount($product_id) {
        $this->product = Product::find($product_id);
    }


    public function add_to_wishlist() {
        if (!Auth::check()) {
            toastr()->error('يجب ان تكون عضوا لكى تضيف منتج الى السله');
        } else {
            $Wishlist = Wishlist::where([
                ['product_id' , '=' , $this->product->id ] , 
                ['user_id' , '=' , Auth::id() ] , 
            ])->first();
            if ($Wishlist) {
                $Wishlist->delete();
                toastr()->success('تم حذف المنتج من قائمه الامنيات ');
            } else {
                $Wishlist = new Wishlist;
                $Wishlist->product_id = $this->product->id;
                $Wishlist->user_id = Auth::id();
                $Wishlist->save();
                toastr()->success('تم إضافه المنتج الى قائمه الامنيات');

            }
        }
    }


    public function render()
    {

        $Wishlist = Wishlist::where([
            ['product_id' , '=' , $this->product->id ] , 
            ['user_id' , '=' , Auth::id() ] , 
        ])->first();
        if ($Wishlist) {
            $isInMyWishList = true;
        }  else {
            $isInMyWishList = false;
        }

        return view('livewire.site.add-to-wishlist' , compact('isInMyWishList'));
    }
}
