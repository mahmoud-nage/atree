<?php

namespace App\Http\Livewire\Board\Products\Variations;

use Livewire\Component;

class ChildVariation extends Component
{

    public $variant;
    public $title;
    public $price;
    public $barcode;
    public $color;


    public function deleteVariant() {
        $this->variant->delete();
        $this->emit('variantDeleted');
        // return redirect(request()->header('Referer'))->with('success' , 'تم الحذف بنجاح' ); 
    }

    public function mount()
    {
        $this->title = $this->variant->title;
        $this->price = $this->variant->price;
        $this->barcode = $this->variant->barcode;
        $this->color = $this->variant->color;
    }

    public function updatedColor()
    {
        $this->variant->color = $this->color;
        $this->variant->save();
    }

    public function updatedTitle()
    {
        $this->variant->title = $this->title;
        $this->variant->save();
    }

    public function updatedPrice()
    {
        if ($this->price == null ) {
            $this->variant->price = null;
        } else {
            $this->variant->price = $this->price;
        }
        $this->variant->save();
    }

    public function updatedBarcode()
    {
        $this->variant->barcode = $this->barcode;
        $this->variant->save();
    }


    public function render()
    {
        return view('livewire.board.products.variations.child-variation');
    }
}
