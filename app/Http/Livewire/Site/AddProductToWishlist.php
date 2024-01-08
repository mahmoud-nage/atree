<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Auth;
use App\Models\Wishlist;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class AddProductToWishlist extends Component
{
    use LivewireAlert;
    public $is_in_wishlist = false;
    public $product;

    public function mount()
    {
        $wishlist = Wishlist::where([
            ['user_id' , '=' , Auth::id() ] , 
            ['product_id' , '=' , $this->product->id ] , 
        ])->first();
        if ($wishlist) {
            $this->is_in_wishlist = true;
        }
    }


    public function updatedIsInWishlist()
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where([
                ['user_id' , '=' , Auth::id() ] , 
                ['product_id' , '=' , $this->product->id ] , 
            ])->first();
            if ($wishlist) {
                $wishlist->delete();
                $this->alert('success' , trans('site.product deleted to wishlist successfully') );

            } else {
                $wishlist = new Wishlist;
                $wishlist->user_id = Auth::id();
                $wishlist->product_id = $this->product->id;
                $wishlist->save();
                $this->alert('success' , trans('site.product added to wishlist successfully') );
            }
        } else {
            $this->is_in_wishlist = false;
            $this->alert('error' , trans('site.you need to login first'));
        }
        
        
    }

    public function render()
    {
        return view('livewire.site.add-product-to-wishlist');
    }
}
