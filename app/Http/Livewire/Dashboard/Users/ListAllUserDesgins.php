<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\UserDesign;
use Livewire\Component;

class ListAllUserDesgins extends Component
{
    public function render()
    {
        $records = UserDesign::where('user_id', request()->route('user')->id)->with(['user', 'products'])->latest()->get();
        return view('livewire.dashboard.users.list-all-user-desgins', compact('records'));
    }
}
