<?php

namespace App\Http\Livewire\Dashboard\Products;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllProducts extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $category_id;

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

    public function mount()
    {
        $this->category_id = 'all';
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $products = Product::query()->with(['user']);

        if($this->search != '')
            $products = $products->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );
        if($this->category_id != 'all')
            $products = $products->where('category_id' , $this->category_id);

        $products = $products->latest()->paginate($this->rows);

        $categories = Category::all();
        return view('livewire.dashboard.products.list-all-products' , compact('products','categories'));
    }
}
