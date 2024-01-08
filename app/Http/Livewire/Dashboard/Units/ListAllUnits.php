<?php

namespace App\Http\Livewire\Dashboard\Units;

use Livewire\Component;
use App\Models\Unit;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllUnits extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $unit = Unit::find($item_id);
        $unit->delete();
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
        $units = Unit::query()->with(['user']);

        if($this->search != '')
            $units = $units->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );

        $units = $units->latest()->paginate($this->rows);


        return view('livewire.dashboard.units.list-all-units' , compact('units'));
    }
}
