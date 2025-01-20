<?php

namespace App\Http\Livewire\Site;

use App\Models\BankAccount;
use Livewire\Component;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserBanks extends Component
{
    use LivewireAlert;

    public $iban;
    public $account_number;
    public $name;
    public $bank_name;

    protected $listeners = ['bankAdded' => '$refresh', 'deleteItem'];
    protected $rules = [
        'name' => 'required',
        'bank_name' => 'required',
        'account_number' => 'required',
        'iban' => 'nullable',
    ];
    public function save()
    {
        $this->validate();
        $address = new BankAccount();
        $address->user_id = Auth::id();
        $address->name = $this->name;
        $address->bank_name = $this->bank_name;
        $address->account_number = $this->account_number;
        $address->iban = $this->iban;
        $address->save();
        $this->emit('bankAdded');
        $this->alert('success', trans('site.Address added successfully'));
    }


    public function makeDefault($address_id)
    {
        BankAccount::where('user_id', Auth::id())->update([
            'is_default' => 0,
        ]);
        $address = BankAccount::find($address_id);
        if ($address) {
            $address->is_default = 1;
            $address->save();
            $this->alert('success', trans('site.Bank Account set is default successfully'));
        }
    }


    public function deleteItem($item_id)
    {
        $item = BankAccount::find($item_id);
        if ($item) {
            $item->delete();
            $this->alert('success', trans('site.Bank Account deleted successfully'));
        }
    }

    public function render()
    {
        $banks = BankAccount::where('user_id', Auth::id())->get();
        return view('livewire.site.user-banks', compact('banks'));
    }
}
