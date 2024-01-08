<?php

namespace App\Http\Livewire\Dashboard\BankAccounts;

use Livewire\Component;
use App\Models\BankAccount;
use Livewire\WithPagination;
class ListAllBankAccounts extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $bank_account = BankAccount::find($item_id);
        $bank_account->delete();
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
        $bank_accounts = BankAccount::query()->with(['user']);

        if($this->search != '')
            $bank_accounts = $bank_accounts->where('name' , 'LIKE' , '%'.$this->search.'%' )->orWhere('account_number' , 'LIKE' , '%'.$this->search.'%' )->orWhere('iban' , 'LIKE' , '%'.$this->search.'%' );

        $bank_accounts = $bank_accounts->latest()->paginate($this->rows);


        return view('livewire.dashboard.bank-accounts.list-all-bank-accounts' , compact('bank_accounts'));
    }
}
