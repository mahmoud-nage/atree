<?php

namespace App\Http\Livewire\Board\Products\Variations;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Variation;
use App\Models\Color;
use App\Models\Size;
class ParentVariation extends Component
{
    use LivewireAlert;
    public $variant;
    public $color_id;
    public $quantity;
    public $size_id;

    protected $listeners = ['variantAdded' => '$refresh' , 'variantDeleted' => '$refresh' ];

    public function deleteVariant() {
        $this->variant->delete();
        $this->emit('variantDeleted');
    }

    public function mount() {
        $this->color_id = $this->variant->color_id;
        $this->quantity = $this->variant->quantity;
        $this->size_id = $this->variant->size_id;
    }

    public function updatedColorId()
    {
        $this->variant->color_id = $this->color_id;
        $this->variant->save();
    }

    public function updatedSizeId()
    {
        $this->variant->size_id = $this->size_id;
        $this->variant->save();
    }


    public function updatedQuantity()
    {
        $this->variant->quantity = $this->quantity;
        $this->variant->save();
    }

    public function render()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('livewire.board.products.variations.parent-variation' , compact('sizes' , 'colors' ) );
    }
}
