<?php

namespace App\Http\Livewire\Dashboard\Designs;

use App\Models\Design;
use Livewire\Component;
use App\Models\Size;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllDesigns extends Component
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
        $records = Design::query()->with(['user', 'products'])->latest()->paginate($this->rows);
        return view('livewire.dashboard.designs.list-all-designs' , compact('records'));
    }
}
