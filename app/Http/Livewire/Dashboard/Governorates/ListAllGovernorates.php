<?php

namespace App\Http\Livewire\Dashboard\Governorates;

use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithPagination;
class ListAllGovernorates extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $governorate = Governorate::find($item_id);
        $governorate->delete();
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
        $governorates = Governorate::query()->with(['user' , 'country' ]);

        if($this->search != '')
            $governorates = $governorates->where('name->ar' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->en' , 'LIKE' , '%'.$this->search.'%' );

        $governorates = $governorates->latest()->paginate($this->rows);


        return view('livewire.dashboard.governorates.list-all-governorates' , compact('governorates'));
    }
}
