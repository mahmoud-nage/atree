<?php

namespace App\Http\Livewire\Dashboard\Coupons;

use Livewire\Component;
use App\Models\Coupon;
use Livewire\WithPagination;
class ListAllCoupons extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';

    protected $listeners = ['deleteItem'];

 

    public function deleteItem($item_id)
    {
        $coupon = Coupon::find($item_id);
        $coupon->delete();
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
        $coupons = Coupon::query()->with('user');

        if($this->search != '')
            $coupons = $coupons->where('code' , 'LIKE' , '%'.$this->search.'%' );

        $coupons = $coupons->latest()->paginate($this->rows);


        return view('livewire.dashboard.coupons.list-all-coupons' , compact('coupons'));
    }
}
