<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Variation;
class ProductDropdown extends Component
{
    public $variations;
    public $selectedVariation;
    

    public function getSelectedVariationModelProperty()
    {
        return Variation::find($this->selectedVariation);
    }


    public function updatedSelectedVariation() {

        $this->emitTo('site.product-selector' , 'finalVariantChoosed' , null );

        if ($this->selectedVariationModel?->barcode) {
            $this->emitTo('site.product-selector' , 'finalVariantChoosed' , $this->selectedVariation );
        }
    }

    public function render()
    {
        return view('livewire.site.product-dropdown');
    }
}
