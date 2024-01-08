<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllCategories extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $category_id;

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $category = Category::find($item_id);
        $image = 'categories/'.$category->image;
        $category->delete();
        DeleteImagesFromAWSJob::dispatch($image);
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
        $this->category_id = 'all';
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $categories = Category::query()->with(['user'])
        ->when($this->search , function($query){
            $query->where('name->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$this->search.'%' );
        })->when($this->category_id != 'all' , function($query){
            $query->where('category_id' , $this->category_id );
        }); 

        $categories = $categories->latest()->paginate($this->rows);

        $all_categories = Category::all();
        return view('livewire.dashboard.categories.list-all-categories' , compact( 'all_categories' ,  'categories'));
    }
}
