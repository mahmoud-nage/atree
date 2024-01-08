<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Wishlist as WishlistModel;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Wishlist extends Component
{

    use LivewireAlert;

    public function removeFromWishList($product_id)
    {
        $Wishlist = WishlistModel::where('product_id' , $product_id)->where('user_id' , Auth::id())->first();
        if ($Wishlist) {
            $Wishlist->delete();
            $this->alert('success' , trans('site.product deleted successfully from Your Wishlist') );
        }
    }


    public function render()
    {
        $wishlist_products = WishlistModel::with(['product'])->where('user_id' , Auth::id() )->get();
        return view('livewire.site.wishlist' , compact('wishlist_products'));
    }
}
