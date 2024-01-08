<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class EditProfile extends Component
{
    use LivewireAlert;
    public $user;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $bio;
    public $username;

    protected function rules()
    {
        return [
            'first_name' => 'required' , 
            'last_name' => 'required' , 
            'phone' => 'required|unique:users,phone,'.Auth::id() , 
            'username' => 'required|unique:users,username,'.Auth::id() , 
            'email' => 'required|email|unique:users,email,'.Auth::id() , 
            'bio' => 'nullable' , 

        ];
    }

    public function mount()
    {
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->phone = $this->user->phone;
        $this->email = $this->user->email;
        $this->bio = $this->user->bio;
        $this->username = $this->user->username;
    }


    public function save()
    {
        $this->validate();

        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        $this->user->phone = $this->phone;
        $this->user->email = $this->email;
        $this->user->bio = $this->bio;
        $this->user->username = trim(str_replace(' ', '', $this->username));
        $this->user->save();

        $this->alert('success' , trans('site.Profile updated successfully') );
    }

    public function render()
    {
        return view('livewire.site.edit-profile');
    }
}
