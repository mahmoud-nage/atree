<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Message;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ContactUsForm extends Component
{
    use LivewireAlert;
    public $name;
    public $phone;
    public $subject;
    public $email;
    public $message;

    public function rules()
    {
        return [
            'name' => 'required' , 
            'phone' => 'required' , 
            'subject' => 'required' , 
            'email' => 'required' , 
            'message' => 'required' , 
        ];
    }

    public function save()
    {
        $this->validate();
        $message = new Message;
        $message->name = $this->name;
        $message->phone = $this->phone;
        $message->subject = $this->subject;
        $message->email = $this->email;
        $message->message = $this->message;
        $message->save();

        $this->name = null;
        $this->phone = null;
        $this->subject = null;
        $this->email = null;
        $this->message = null;


        $this->alert('success' , trans('site.Message send successfully'), [
            'position' => 'center' , 
            'toast' => false , 
        ] );
    }

    public function render()
    {
        return view('livewire.site.contact-us-form');
    }
}
