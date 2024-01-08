<?php

namespace App\Http\Livewire\Board\Products;

use Livewire\Component;
use App\Models\Variation;
class Variations extends Component
{
    public $product;

    protected $listeners = ['variantDeleted' , 'variantAdded' => '$refresh'  ];

    public function variantDeleted()
    {
        $this->render();
    }

    public function render()
    {
        $variations = Variation::where('product_id' , $this->product->id)->get();
        return view('livewire.board.products.variations' , compact('variations') );
    }
}
