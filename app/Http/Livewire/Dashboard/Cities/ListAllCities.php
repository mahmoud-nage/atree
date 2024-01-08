<?php

namespace App\Http\Livewire\Dashboard\Cities;

use Livewire\Component;
use App\Models\City;
use Livewire\WithPagination;
class ListAllCities extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $city = City::find($item_id);
        $city->delete();
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
        $cities = City::query()->with(['user' , 'governorate' ]);

        if($this->search != '')
            $cities = $cities->where('name->ar' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->en' , 'LIKE' , '%'.$this->search.'%' );

        $cities = $cities->latest()->paginate($this->rows);


        return view('livewire.dashboard.cities.list-all-cities' , compact('cities'));
    }
}
