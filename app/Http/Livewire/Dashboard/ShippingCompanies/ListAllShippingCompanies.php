<?php

namespace App\Http\Livewire\Dashboard\ShippingCompanies;

use App\Models\ShippingCompanies;
use Livewire\Component;
use Livewire\WithPagination;
class ListAllShippingCompanies extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $category_id;

    protected $listeners = ['deleteItem'];



    public function deleteItem($item_id)
    {
        $item = ShippingCompanies::find($item_id);
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
        $records = ShippingCompanies::query()
        ->when($this->search , function($query){
            $query->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );
        });

        $records = $records->latest()->paginate($this->rows);
        return view('livewire.dashboard.shipping_companies.list-all-shipping-companies' , compact('records'));
    }
}
