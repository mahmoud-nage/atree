<?php

namespace App\Http\Livewire\Site;

use App\Models\Design;
use App\Models\DesignProduct;
use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class CreateDesign extends Component
{
    use LivewireAlert, WithFileUploads;

    public $product_id;
    public $description;
    public $image;
    public $record;

    protected $listeners = ['addressAdded' => '$refresh', 'deleteItem'];
    protected $rules = [
        'product_id' => 'required',
        'description' => 'required',
        'image' => 'required',
    ];

//
    public function mount($id = null)
    {
        $design = Design::find($id);
        if($design){
            $this->user_id = $design->id;
            $this->description = $design->description;
            $this->product_id = $design->products()->pluck('product_id');
        }
    }


    public function getProductsProperty()
    {
        return Product::get();
    }

    public function save()
    {
        $this->validate();
        $design = new Design;
        $design->user_id = auth()->id();
        $design->description = $this->description;
        $design->image = basename($this->image->store('designs'));
        $design->save();
        $design->products()->sync($this->product_id);
        $this->emit('addressAdded');
        $this->alert('success', trans('site.Design added successfully'));
    }

    public function deleteItem($item_id)
    {
        $item = Design::find($item_id);
        if ($item) {
            $item->products()->detach();
            $item->delete();
            $this->alert('success', trans('site.Address deleted successfully'));
        }
    }

    public function render()
    {
        $records = Design::with(['products'])->where('user_id', auth()->id())->get();
        return view('livewire.site.create-design', compact('records'));
    }
}
