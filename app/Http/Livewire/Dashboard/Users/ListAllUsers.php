<?php

namespace App\Http\Livewire\Dashboard\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllUsers extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];



    public function deleteItem($item_id)
    {
        $item = User::find($item_id);
        $image = 'users/'.$item->image;
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
        $users = User::query()->whereType(User::USER);


        $users->when($this->search , function($query){
            $query->where('name' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name' , 'LIKE' , '%'.$this->search.'%' )->orWhere('phone' , 'LIKE' , '%'.$this->search.'%' )->orWhere('email' , 'LIKE' , '%'.$this->search.'%' );
        });
        $users = $users->latest()->paginate($this->rows);
        return view('livewire.dashboard.users.list-all-users' , compact('users'));
    }
}
