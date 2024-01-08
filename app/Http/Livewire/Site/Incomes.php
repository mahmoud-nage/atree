<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Income;
use Auth;
class Incomes extends Component
{
    public function render()
    {
        $incomes = Income::where('user_id' , Auth::id() )->latest()->get();
        return view('livewire.site.incomes' , compact('incomes'));
    }
}
