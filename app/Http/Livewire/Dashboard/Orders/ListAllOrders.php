<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Country;
use Livewire\Component;
use App\Models\Order;
use App\Models\City;
use App\Models\Governorate;
use Livewire\WithPagination;
use App\Models\ShippingStatus;
use App\Exports\Dashboard\Orders\OrdersExcelReportExport;
use App\Imports\Dashboard\Orders\OrdersExcelReportImport;
use Excel;
use Livewire\WithFileUploads;
class ListAllOrders extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $rows = 10;
    public $search ;
    public $shipping_status = 'all' ;
    public $start_date;
    public $end_date;
    public $file;
    public $country_id;
    public $governorate_id;
    public $city_id;

    protected $listeners = ['deleteItem'];



    public function deleteItem($item_id)
    {
        $order = Order::find($item_id);
        $order->delete();
        $this->emit('itemDeleted');
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function getCountriesProperty()
    {
        return Country::all();
    }
    public function getGovernoratesProperty()
    {
        return Governorate::where('country_id' , $this->country_id )->get();
    }

    public function getCitiesProperty()
    {
        return City::where('governorate_id' , $this->governorate_id )->get();
    }

    public function updatedRows()
    {
        $this->resetPage();
    }
    public function mount()
    {
        if(request()->shipping_status){
            $this->shipping_status = request()->shipping_status;
        }
    }

    public function UploadFile()
    {
        $this->validate([
            'file' => 'required|mimes:xlx,xlsx',
        ]);
        Excel::import(new OrdersExcelReportImport, $this->file);
        $this->emit('withdrawalsUpdated');

    }

    public function ExcelReport() {
        $orders = Order::when($this->search , function($query){
            $query->where('number' , 'LIKE' , '%'.$this->search.'%' )
                ->orWhere('order_phone' ,  'LIKE' , '%'.$this->search.'%'  )
                ->orWhere('client_name' ,  'LIKE' , '%'.$this->search.'%'  );
        })
            ->when($this->shipping_status != 'all' , function($query){
                $query->where('shipping_statues_id' , $this->shipping_status );
            })
            ->when($this->start_date , function($query){
                $query->whereDate('created_at' , '>=' , $this->start_date );
            })
            ->when($this->end_date , function($query){
                $query->whereDate('created_at' , '<=' , $this->end_date );
            })
            ->when($this->country_id , function($query){
                $query->where('country_id' ,$this->country_id );
            })
            ->when($this->governorate_id , function($query){
                $query->where('governorate_id' ,$this->governorate_id );
            })
            ->latest()->get();

        return Excel::download(new OrdersExcelReportExport($orders), 'orders.xlsx');
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $shipping_statues = ShippingStatus::all();
        $orders = Order::when($this->search , function($query){
            $query->where('number' , 'LIKE' , '%'.$this->search.'%' )->orWhere('order_phone' ,  'LIKE' , '%'.$this->search.'%'  )->orWhere('client_name' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->when(request()->user_id , function($query){
            $query->where('user_id' , request()->user_id );
        })
        ->when($this->shipping_status != 'all', function($query){
            $query->where('shipping_statues_id' , $this->shipping_status );
        })
        ->when($this->start_date , function($query){
            $query->whereDate('created_at' , '>=' , $this->start_date );
        })
        ->when($this->end_date , function($query){
            $query->whereDate('created_at' , '<=' , $this->end_date );
        })
        ->when($this->country_id , function($query){
            $query->where('country_id' ,$this->country_id );
        })
        ->when($this->governorate_id , function($query){
            $query->where('governorate_id' ,$this->governorate_id );
        })
        ->latest()
        ->paginate($this->rows);


        return view('livewire.dashboard.orders.list-all-orders' , compact('orders' , 'shipping_statues'));
    }
}
