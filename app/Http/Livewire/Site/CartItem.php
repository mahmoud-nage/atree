<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class CartItem extends Component
{   
    use LivewireAlert;

    public $item;
    public $price;
    public $quantity;


    public function mount()
    {
        $this->price = $this->item->price;
        $this->quantity = $this->item->quantity;
    }


    public function updatedPrice()
    {
        $this->item->price = $this->price;
        $this->item->save();
        $this->emitTo('site.cart' , 'cartChanged');
    }

    public function updatedQuantity()
    {
        $this->item->quantity = $this->quantity;
        $this->item->save();
        $this->emitTo('site.cart' , 'cartChanged');
    }

    public function removeItem() {
        $this->item->delete();
        $this->alert( 'success' ,  'تم حذف المنتج من السله بنجاح');
        $this->emitTo( 'site.cart' ,  'cartChanged');
    }


    public function editQuantity($quantity)
    {
        $this->item->quantity = $quantity;
        $this->item->save();
        $this->alert( 'success' ,  'تم تعديل المنتج من السله بنجاح');
        $this->emitSelf('cartChanged');
    }



    public function render()
    {
        return view('livewire.site.cart-item');
    }
}
