<?php

namespace App\Http\Livewire\Dashboard\Withdrawals;

use Livewire\Component;
use App\Models\Withdrawals;
class QuickView extends Component
{

    public $withdrawal ;
    protected $listeners = ['quick-view' => 'launch' ];


    public function mount()
    {
        $this->withdrawal = new Withdrawals;
    }


    public function launch($withdrawal_id)
    {
        $withdrawal = Withdrawals::find($withdrawal_id);
        if ($withdrawal) {
            $this->withdrawal = $withdrawal;
            $this->emit('lanuchModal');
        }
    }


    public function render()
    {
        return view('livewire.dashboard.withdrawals.quick-view');
    }
}
