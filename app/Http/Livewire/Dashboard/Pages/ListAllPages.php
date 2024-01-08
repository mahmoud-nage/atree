<?php

namespace App\Http\Livewire\Dashboard\Pages;

use Livewire\Component;
use App\Models\Page;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllPages extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $page = Page::find($item_id);
        $page->delete();
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
        $pages = Page::query()->with(['user']);

        if($this->search != '')
            $pages = $pages->where('title->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('title->ar' , 'LIKE' , '%'.$this->search.'%' );

        $pages = $pages->latest()->paginate($this->rows);


        return view('livewire.dashboard.pages.list-all-pages' , compact('pages'));
    }
}
