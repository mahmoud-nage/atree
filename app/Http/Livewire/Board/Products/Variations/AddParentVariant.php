<?php

namespace App\Http\Livewire\Board\Products\Variations;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Models\Variation;
use App\Models\Color;
use App\Models\Size;
use Auth;
class AddParentVariant extends Component
{

    use LivewireAlert;
    use WithFileUploads;
    public $product;
    public $color_id;
    public $size_id;
    public $quantity;


    protected $rules = [
        'color_id' => 'required',
        'size_id' => 'nullable',
        'quantity' => 'required',
    ];


    protected $listeners = ['openModal'];


    public function save()
    {
        $this->validate();
        $variant = new Variation;
        $variant->product_id = $this->product->id;
        $variant->color_id = $this->color_id;
        $variant->size_id = $this->size_id;
        $variant->quantity = $this->quantity;
        $variant->user_id = Auth::id();
        $variant->save();
        $this->color_id = null;
        $this->size_id = null;
        $this->quantity = null;
        $this->emit('close_add_modal');
        $this->emit('variantAdded');
        $this->alert('success' , 'تم الاضافه بنجاح' );
    }


    public function render()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('livewire.board.products.variations.add-parent-variant' , compact('sizes' , 'colors' ) );
    }
}
