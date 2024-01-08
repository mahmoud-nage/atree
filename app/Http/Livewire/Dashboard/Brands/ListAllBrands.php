<?php

namespace App\Http\Livewire\Dashboard\Brands;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllBrands extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $brand = Brand::find($item_id);
        $image = 'brands/'.$brand->image;
        $brand->delete();
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
        $brands = Brand::query()->with(['user']);

        if($this->search != '')
            $brands = $brands->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );

        $brands = $brands->latest()->paginate($this->rows);


        return view('livewire.dashboard.brands.list-all-brands' , compact('brands'));
    }
}
