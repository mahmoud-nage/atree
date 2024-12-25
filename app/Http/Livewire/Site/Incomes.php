<?php

namespace App\Http\Livewire\Site;

use App\Models\Order;
use App\Models\UserPoint;
use Livewire\Component;
use App\Models\Income;
use Auth;
class Incomes extends Component
{
    public function render()
    {
        $orders_count = Order::where('user_id' , Auth::id() )->count();
        $total_incomes = Income::where('user_id' , Auth::id() )->sum('amount');
        $total_incomes_withdrawal = Income::where('user_id' , Auth::id() )->where('withdrawn' , 1 )->sum('amount');
        $total_incomes_not_withdrawal =  Income::where('user_id' , Auth::id() )->where('withdrawn' , 0 )->sum('amount');
        $total_points = UserPoint::where('user_id' , Auth::id() )->sum('points');

        $incomes = Income::where('user_id' , Auth::id() )->latest()->get();
        return view('livewire.site.incomes' , compact('incomes','orders_count','total_incomes','total_incomes_withdrawal','total_points','total_incomes_not_withdrawal'));
    }
}
