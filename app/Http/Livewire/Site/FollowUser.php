<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Auth;
use App\Models\Follower;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class FollowUser extends Component
{
    use LivewireAlert;

    public $designer;

    public function follow()
    {

        if (!Auth::check()) {
            $this->alert('error' , trans('site.you need to login first') );
            return true;
        }


        $follower = Follower::where([
            ['user_id' , '=' , Auth::id() ] , 
            ['designer_id' , '=' , $this->designer->id  ] , 
        ])->first();

        if ($follower) {
            $follower->delete();
            $this->alert('success' , trans('site.UnFollowed Successfully') );
            return;
        }

        $follower = new Follower;
        $follower->user_id = Auth::id();
        $follower->designer_id = $this->designer->id;
        $follower->save();
        $this->alert('success' , trans('site.Followed Successfully') );
    }

    public function render()
    {
        $check = Follower::where([
            ['user_id' , '=' , Auth::id() ] , 
            ['designer_id' , '=' , $this->designer->id  ] , 
        ])->first();

        if ($check) {
            $this->is_in_my_follwe_list = true;
        } else {
            $this->is_in_my_follwe_list = false;
        }
        return view('livewire.site.follow-user');
    }
}
