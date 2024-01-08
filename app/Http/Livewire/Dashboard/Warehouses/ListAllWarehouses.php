<?php

namespace App\Http\Livewire\Dashboard\Warehouses;

use Livewire\Component;
use App\Models\Warehouse;
use Livewire\WithPagination;

class ListAllWarehouses extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $warehouse = Warehouse::find($item_id);

        $warehouse->delete();

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
        $warehouses = Warehouse::query()->with(['user']);

        if($this->search != '')
            $warehouses = $warehouses->where('name' , 'LIKE' , '%'.$this->search.'%' );

        $warehouses = $warehouses->latest()->paginate($this->rows);


        return view('livewire.dashboard.warehouses.list-all-warehouses' , compact('warehouses'));
    }
}
