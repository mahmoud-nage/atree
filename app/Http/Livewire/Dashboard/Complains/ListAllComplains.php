<?php

namespace App\Http\Livewire\Dashboard\Complains;

use Livewire\Component;
use App\Models\Complain;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllComplains extends Component
{
    use WithPagination;
    public $rows = 10;
    public $type;
    public $category;
    public $seen;
    protected $listeners = ['deleteItem'];


    public function mount()
    {
        $this->seen = 'all';
        $this->type = 'all';
        $this->category = 'all';
    }

    public function deleteItem($item_id)
    {
        $Complain = Complain::find($item_id);
        $Complain->delete();
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
        $complains = Complain::query()->with(['user'])
        ->when($this->type != 'all' , function($query){
            $query->where('type' , $this->type);
        })
        ->when($this->category != 'all' , function($query){
            $query->where('category' , $this->category);
        })
        ->when($this->seen != 'all' , function($query){
            $query->where('seen' , $this->seen);
        });

        $complains = $complains->latest()->paginate($this->rows);


        return view('livewire.dashboard.complains.list-all-complains' , compact('complains'));
    }
}
