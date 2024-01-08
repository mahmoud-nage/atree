<?php

namespace App\Http\Livewire\Dashboard\Sizes;

use Livewire\Component;
use App\Models\Size;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllSizes extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $category_id;

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $item = Size::find($item_id);
        $item->delete();
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
        $sizes = Size::query()->with(['user'])
        ->when($this->search , function($query){
            $query->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );
        }); 

        $sizes = $sizes->latest()->paginate($this->rows);
        return view('livewire.dashboard.sizes.list-all-sizes' , compact('sizes'));
    }
}
