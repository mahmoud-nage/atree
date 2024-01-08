<?php

namespace App\Http\Livewire\Dashboard\Countries;

use Livewire\Component;
use App\Models\Country;
use Livewire\WithPagination;
class ListAllCountries extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];



    public function deleteItem($item_id)
    {
        $country = Country::find($item_id);
        if ($country) {
            $country->delete();
            $this->emit('itemDeleted');
            $this->resetPage();
        }
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
        $countries = Country::query()->with(['user'  ]);

        if($this->search != '')
            $countries = $countries->where('name->ar' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->en' , 'LIKE' , '%'.$this->search.'%' );

        $countries = $countries->latest()->paginate($this->rows);


        return view('livewire.dashboard.countries.list-all-countries' , compact('countries'));
    }
}
