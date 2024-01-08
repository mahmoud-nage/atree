<?php

namespace App\Http\Livewire\Dashboard\Challenges;

use Livewire\Component;
use App\Models\Challenge;
use Livewire\WithPagination;
class ListAllChallenges extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $challenge = Challenge::find($item_id);
        $challenge->delete();
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
        $challenges = Challenge::query()->with('user');

        if($this->search != '')
            $challenges = $challenges->where('title' , 'LIKE' , '%'.$this->search.'%' );

        $challenges = $challenges->latest()->paginate($this->rows);


        return view('livewire.dashboard.challenges.list-all-challenges' , compact('challenges'));
    }
}
