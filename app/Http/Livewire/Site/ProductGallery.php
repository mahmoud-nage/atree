<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Storage;
class ProductGallery extends Component
{

    public $product;
    public $image;


    public function mount()
    {
        $this->image = Storage::url('products/'.$this->product->image);
    }

    public function changeImageTo($image)
    {
        $this->image = $image;
    }

    public function render()
    {
        return view('livewire.site.product-gallery');
    }
}
