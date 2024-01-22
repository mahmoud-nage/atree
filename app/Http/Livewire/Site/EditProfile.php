<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use LivewireAlert, WithFileUploads;

    public $user;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $bio;
    public $username;
    public $image;
    public $banner;

    protected function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:users,phone,' . auth()->id(),
            'username' => 'required|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'bio' => 'nullable',
            'image' => 'nullable|image',
            'banner' => 'nullable|image',
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
        $this->user->image = $this->hasFile('image') ? basename($this->image->store('users')) : $this->user->image;
        $this->user->banner = $this->hasFile('image') ? basename($this->banner->store('users')) : $this->user->banner;
        $this->user->save();
        $this->alert('success', trans('site.Profile updated successfully'));
    }

    public function render()
    {
        return view('livewire.site.edit-profile');
    }
}
