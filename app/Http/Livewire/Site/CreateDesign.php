<?php

namespace App\Http\Livewire\Site;

use App\Models\Design;
use App\Models\DesignProduct;
use App\Models\Product;
use App\Models\UserDesign;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class CreateDesign extends Component
{
    use LivewireAlert, WithFileUploads;

//    public $product_id;
    public $description;
    public $image;
    public $record;

    protected $listeners = ['addressAdded' => '$refresh', 'deleteItem'];
    protected $rules = [
//        'product_id' => 'required',
        'description' => 'required',
    ];

//
    public function mount($id = null)
    {
        $design = UserDesign::find($id);
        if ($design) {
            $this->id = $design->id;
            $this->user_id = $design->user_id;
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
        $design = UserDesign::find($this->id);
        $design->description = $this->description;
        $design->save();
//        $design->products()->sync($this->product_id);
        $this->emit('addressAdded');
        $this->alert('success', trans('site.Design Updated successfully'));
    }

    public function deleteItem($item_id)
    {
        $item = UserDesign::find($item_id);
        if ($item) {
            $item->products()->detach();
            $item->delete();
            $this->alert('success', trans('site.Address deleted successfully'));
        }
    }

    public function getInfo($item_id)
    {
        $item = UserDesign::find($item_id);
        if ($item) {
            $this->id = $item->id;
            $this->user_id = $item->user_id;
            $this->description = $item->description;
            $this->product_id = $item->products()->pluck('product_id');

        }
    }

    public function render()
    {
        $user_id = null;
        if (request()->route('user')) {
            $user_id = request()->route('user')->id;
        }
        $records = UserDesign::with(['products'])->where('user_id', $user_id)->latest()->get();
        return view('livewire.site.create-design', compact('records'));
    }
}
