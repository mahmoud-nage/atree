<?php

namespace App\Http\Livewire\Dashboard\Slides;

use Livewire\Component;
use App\Models\Slide;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
class ListAllSlide extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $slide = Slide::find($item_id);
        $image = 'slides/'.$slide->image;
        $slide->delete();
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

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $slides = Slide::query()->with(['user']);

        if($this->search != '')
            $slides = $slides->where('title->en' , 'LIKE' , '%'.$this->search.'%' )->orWhere('title->ar' , 'LIKE' , '%'.$this->search.'%' );

        $slides = $slides->latest()->paginate($this->rows);


        return view('livewire.dashboard.slides.list-all-slide' , compact('slides'));
    }
}
