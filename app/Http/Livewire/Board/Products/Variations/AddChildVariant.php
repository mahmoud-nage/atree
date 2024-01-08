<?php

namespace App\Http\Livewire\Board\Products\Variations;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Models\Variation;
use Auth;
class AddChildVariant extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $variantId;
    public $variant;
    public $title;
    public $barcode;
    public $price;
    public $color;
    public $images;

    protected $rules = [
        'title' => 'required',
        'barcode' => 'nullable',
        'price' => 'nullable',
        'color' => 'required',
        'images.*' => 'required|image'
    ];

    protected $listeners = ['openModal'];

    public function openModal($variantId) {
        $this->variantId = $variantId;
        $this->emit('open_add_modal');
        $this->variant = Variation::find($variantId);
    }


    public function save()
    {
        $this->validate();
        $variant = new Variation;
        $variant->parent_id = $this->variantId;
        $variant->title = $this->title;
        $variant->barcode = $this->barcode;
        $variant->price = $this->price;
        $variant->color = $this->color;
        $variant->type = 'color';
        $variant->user_id = Auth::id();
        $variant->product_id = $this->variant->product_id;
        $variant->save();
        $this->barcode = null;
        $this->title = null;
        $this->price = null;
        $this->color = null;
        $this->images = null;
        $this->emit('close_add_modal');
        $this->emit('variantAdded');
        $this->alert('success' , 'تم الاضافه بنجاح' );
    }


    public function render()
    {
        return view('livewire.board.products.variations.add-child-variant');
    }
}
