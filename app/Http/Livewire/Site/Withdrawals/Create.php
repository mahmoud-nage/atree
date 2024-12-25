<?php

namespace App\Http\Livewire\Site\Withdrawals;

use App\Models\BankAccount;
use Livewire\Component;

class Create extends Component
{
    public $type;
    public function render()
    {
        $banks = BankAccount::where('user_id', auth()->id())->get();
        return view('livewire.site.withdrawals.create',compact('banks'));
    }
}
