<?php

namespace App\Http\Livewire\Dashboard\Colors;

use Livewire\Component;
use App\Models\Color;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllColors extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $category_id;

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $item = Color::find($item_id);
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
        $colors = Color::query()->with(['user'])
        ->when($this->search , function($query){
            $query->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );
        }); 

        $colors = $colors->latest()->paginate($this->rows);
        return view('livewire.dashboard.colors.list-all-colors' , compact('colors'));
    }
}
