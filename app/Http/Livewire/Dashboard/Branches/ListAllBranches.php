<?php

namespace App\Http\Livewire\Dashboard\Branches;

use Livewire\Component;
use App\Models\Branch;
use Livewire\WithPagination;
class ListAllBranches extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $brand->delete();
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
        $branches = Branch::query();

        if($this->search != '')
            $branches = $branches->where('name' , 'LIKE' , '%'.$this->search.'%' )->orWhere('phone1' , 'LIKE' , '%'.$this->search.'%' )->orWhere('phone2' , 'LIKE' , '%'.$this->search.'%' )->orWhere('mobile' , 'LIKE' , '%'.$this->search.'%' )->orWhere('fax' , 'LIKE' , '%'.$this->search.'%' );

        $branches = $branches->latest()->paginate($this->rows);


        return view('livewire.dashboard.branches.list-all-branches' , compact('branches'));
    }
}
