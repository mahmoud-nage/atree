<?php

namespace App\Http\Livewire\Dashboard\Admins;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllAdmins extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $type;

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $admin = User::find($item_id);
        $image = 'admins/'.$admin->image;
        $admin->delete();
        DeleteImagesFromAWSJob::dispatch($image);
        $this->emit('itemDeleted');
        $this->resetPage();
    }
    public function mount()
    {
        $this->type = 'all';
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
        $admins = User::where('type' , 2);

        if($this->search != '')
            $admins = $admins->where('name' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name' , 'LIKE' , '%'.$this->search.'%' );

        if ($this->type != 'all') {
            $admins = $admins->where('type' , $this->type );

        }

        $admins = $admins->latest()->paginate($this->rows);


        return view('livewire.dashboard.admins.list-all-admins' , compact('admins'));
    }
}
