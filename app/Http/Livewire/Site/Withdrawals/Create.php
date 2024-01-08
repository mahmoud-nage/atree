<?php

namespace App\Http\Livewire\Site\Withdrawals;

use Livewire\Component;

class Create extends Component
{
    public $type;
    public function render()
    {
        return view('livewire.site.withdrawals.create');
    }
}
