<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Variation;
use App\Models\Wishlist;
use Auth;
use App\Models\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ProductSelector extends Component
{
    use LivewireAlert;
    public $product;
    public $initialVariation;
    public $finalVariant;
    public $productPrice;
    public $hasVariant = false;
    public $isInMyWishList = false;
    public $quantity = 1;
    protected $listeners = ['finalVariantChoosed'];
    public function mount()
    {
        $this->initialVariation = $this->product->variations->where('type' , '!=' , 'one_size' )->sortBy('order')->groupBy('type')->first();
        $this->productPrice = $this->product->price;
        if ($this->initialVariation) {
            $this->hasVariant = true;
        } else {
            $this->hasVariant = false;
            $one_size_variation = $this->product->variations->first();
            $this->finalVariantChoosed($one_size_variation->id);
        }

        if (Auth::check()) {
            $this->isInMyWishList = Wishlist::where([
                ['user_id' , '=' , Auth::id() ] , 
                ['product_id' , '=' , $this->product->id  ]
            ])->first() ? true : false;
        }
    }


    public function increasQuantity()
    {
        $this->quantity++;
    }

    public function dcreasQuantity()
    {
        if ($this->quantity == 1 ) {
            return;
        }
        $this->quantity--;
    }


    public function add_to_cart()
    {
        if (!Auth::check()) {
            $this->alert('info' , 'يجب ان تكون مستخدم لكى تستطيع الإضافه الى سله التسوق', [
                'toast' => false  , 
                'position' => 'center' , 
                'timer' => 3000 , 
            ]);

            return ;
        }

        // we need to check first if this item in cart or not
        $cart_item = Cart::where([
            ['variation_id' , '=' , $this->finalVariant->id ] , 
            ['user_id' , '=' , Auth::id() ] , 
        ])->first();

        if ($cart_item) {
            $cart_item->quantity = $cart_item->quantity + $this->quantity;
            $cart_item->save();
        } else {
            $cart = new Cart;
            $cart->variation_id = $this->finalVariant->id;
            $cart->quantity = $this->quantity;
            $cart->user_id = Auth::id();
            $cart->price = $this->finalVariant->product?->getPrice();
            $cart->save();
        }
        $this->alert( 'success' ,  'تم إضافه المنتج '.$this->finalVariant?->product->name.' الى السله بنجاح' );

    }

    public function finalVariantChoosed($variateId)
    {
        if (!$variateId) {
            $this->finalVariant = null;
            $this->productPrice = $this->product->price ;
            return;
        }

        $this->finalVariant = Variation::find($variateId);
        $this->productPrice = $this->finalVariant?->price ? $this->finalVariant?->price : $this->product->price ;
    }
    public function add_to_wishlist() {
        if (!Auth::check()) {
            $this->alert('error', 'يجب ان تكون عضوا لكى تضيف منتج الى السله');

        } else {
            $Wishlist = Wishlist::where([
                ['product_id' , '=' , $this->product->id ] , 
                ['user_id' , '=' , Auth::id() ] , 
            ])->first();
            if ($Wishlist) {
                $Wishlist->delete();
                $this->isInMyWishList = false;
                $this->alert('success', 'تم حذف المنتج من قائمه الامنيات');
            } else {
                $Wishlist = new Wishlist;
                $Wishlist->product_id = $this->product->id;
                $Wishlist->user_id = Auth::id();
                $Wishlist->save();
                $this->isInMyWishList = true;
                $this->alert( 'success' ,  'تم إضافه المنتج الى قائمه الامنيات');
            }
        }
    }

    public function render()
    {
        return view('livewire.site.product-selector');
    }
}
