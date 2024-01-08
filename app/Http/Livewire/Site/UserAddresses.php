<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\City;
use App\Models\UserAddress;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class UserAddresses extends Component
{
     use LivewireAlert;

    public $user;
    public $country_id;
    public $governorate_id;
    public $city_id;
    public $building_number;
    public $street_name;
    public $district;

    protected $listeners = ['addressAdded' => '$refresh' , 'deleteItem'  ];
    protected $rules = [
        'country_id' => 'required' , 
        'governorate_id' => 'required' , 
        'city_id' => 'required' , 
        'building_number' => 'required' , 
        'street_name' => 'required' , 
        'district' => 'required' , 
    ];


    public function getCountriesProperty()
    {
        return Country::where('active' , 1 )->get();
    }


    public function getGovernoratesProperty()
    {
        return Governorate::where('active' , 1 )->where('country_id' , $this->country_id )->get();
    }


    public function getCitiesProperty()
    {
        return City::where('active' , 1 )->where('governorate_id' , $this->governorate_id )->get();
    }



    public function save()
    {
        $this->validate();

        $address = new UserAddress;
        $address->user_id = Auth::id();
        $address->governorate_id = $this->governorate_id;
        $address->city_id = $this->city_id;
        $address->country_id = $this->country_id;
        $address->building_number = $this->building_number;
        $address->street_name = $this->street_name;
        $address->district = $this->district;
        $address->save();
        $this->emit('addressAdded');
        $this->alert('success' , trans('site.Address added successfully') );
    }



    public function makeDefault($address_id)
    {
        UserAddress::where('user_id' , Auth::id() )->update([
            'is_default' => 0 , 
        ]);
        $address = UserAddress::find($address_id);
        if ($address) {
            $address->is_default = 1;
            $address->save();
            $this->alert('success'  , trans('site.Address set is default successfully') );
        }
    }


    public function deleteItem($item_id)
    {
        $item = UserAddress::find($item_id);
        if ($item) {
            $item->delete();
            $this->alert('success' , trans('site.Address deleted successfully') );
        }
    }

    public function render()
    {
        $addresses = UserAddress::with(['country' , 'city' , 'governorate' ])->where('user_id' , Auth::id() )->get();
        return view('livewire.site.user-addresses' , compact('addresses') );
    }
}
