<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Order;
use App\Models\Governorate;
use App\Models\City;
use App\Models\ShippingStatus;
use Auth;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Orders extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $order;
    public $return_reason;
    public $description;
    public $city_id;
    public $governorate_id;
    public $status;

    public function getGovernoratesProperty()
    {
        return Governorate::all();
    }

    public function getCitiesProperty()
    {
        return City::where('governorate_id' , $this->governorate_id )->get();
    }


    public function cancelOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->shipping_statues_id = 6;
            $order->save();
            $this->alert('success', 'تم الغاء الطلب بنجاح');
        }
    }

    public function mount()
    {
        $this->order = new Order;
    }


    public function returnOrder($order_id)
    {
        $this->emit('showReturnOrderModal',$order_id);
    }

    public function saveReturnOrder($order_id)
    {
        dd($order_id , $this->description , $this->return_reason);
    }

    public function render()
    {
        $orders = Order::with(['items.variation' , 'governorate' , 'status'])
        ->where(function($query){
            $query->where('user_id' , Auth::id() );
        })
        ->when($this->governorate_id , function($query){
            $query->where('governorate_id' , $this->governorate_id );
        })
        ->when($this->city_id , function($query){
            $query->where('city_id' , $this->city_id );
        })
        ->when($this->status , function($query){
            $query->where('shipping_statues_id' , $this->status );
        })
        ->latest()->paginate(1);
        $shipping_statues = ShippingStatus::all();
        return view('livewire.site.orders' , compact('orders' , 'shipping_statues' ));
    }
}
