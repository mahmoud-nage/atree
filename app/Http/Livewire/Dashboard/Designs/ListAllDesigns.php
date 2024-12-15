<?php

namespace App\Http\Livewire\Dashboard\Designs;

use App\Models\Design;
use App\Models\User;
use App\Models\UserDesign;
use Livewire\Component;
use App\Models\Size;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllDesigns extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $user_id;

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

    public function mount()
    {
        if(request()->user_id){
            $this->user_id = request()->user_id;
        }else{
            $this->user_id = 'all';
        }
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $records = UserDesign::query()
            ->when($this->user_id != 'all' , function($query){
                $query->where('user_id' , $this->user_id );
            })->with(['user', 'products'])->latest()->paginate($this->rows);

        $designers = User::query()->whereType(User::USER)->get();
        return view('livewire.dashboard.designs.list-all-designs' , compact('records', 'designers'));
    }
}
