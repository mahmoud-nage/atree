<?php

namespace App\Http\Livewire\Dashboard\Messages;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithPagination;
class ListAllMessage extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $message = Message::find($item_id);
        $message->delete();
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
        $messages = Message::query();

        if($this->search != '')
            $messages = $messages->where('name' , 'LIKE' , '%'.$this->search.'%' )->orWhere('phone' , 'LIKE' , '%'.$this->search.'%' )->orWhere('email' , 'LIKE' , '%'.$this->search.'%' );

        $messages = $messages->latest()->paginate($this->rows);


        return view('livewire.dashboard.messages.list-all-message' , compact('messages'));
    }
}
