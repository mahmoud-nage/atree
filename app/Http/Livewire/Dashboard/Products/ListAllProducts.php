<?php

namespace App\Http\Livewire\Dashboard\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllProducts extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $product = Product::find($item_id);
        $image = 'products/'.$product->image;
        $product->delete();
        DeleteImagesFromAWSJob::dispatch($image);
        $this->emit('itemDeleted');
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedRows()
    {
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $products = Product::query()->with(['user']);

        if($this->search != '')
            $products = $products->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );

        $products = $products->latest()->paginate($this->rows);

        return view('livewire.dashboard.products.list-all-products' , compact('products'));
    }
}
