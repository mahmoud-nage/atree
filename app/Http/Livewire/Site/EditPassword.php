<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Hash;
use Auth;
class EditPassword extends Component
{

    use LivewireAlert;
    public $user;
    public $old_password;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'old_password' => 'required' , 
            'password' => 'required|confirmed|min:8' , 
        ];
    }

    public function save()
    {
        $this->validate();

        if (!Hash::check($this->old_password,  Auth::user()->password )) {
            $this->alert('error' , trans('site.Old Password is not correct')  , [
                'position' => 'center' , 
                'toast' => false
            ]);
            return;
        }

        $this->user->password = Hash::make($this->password);
        $this->user->save();
        $this->alert('success' , trans('site.Password updated successfully') );
    }

    public function render()
    {
        return view('livewire.site.edit-password');
    }
}
