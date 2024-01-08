<?php

namespace App\Http\Livewire\Dashboard\Products\Variations;

use Livewire\Component;
use App\Models\Size;
class Create extends Component
{

    public  $componantCount = 1;


    public function render()
    {
        $sizes = Size::all(); 
        return view('livewire.dashboard.products.variations.create' , compact('sizes'));
    }
}
