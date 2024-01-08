<?php

namespace App\Http\Livewire\Dashboard\Products\Variations\Create;

use Livewire\Component;

class AddRow extends Component
{
    public $count = 1;

    protected $listeners = ['rowDeleted'];


    public function rowDeleted()
    {
        $this->count--;
    }

    public function increase()
    {
        $this->count++;
        $this->emit('increaseRow' , $this->count );
    }


    public function render()
    {
        return view('livewire.dashboard.products.variations.create.add-row');
    }
}
