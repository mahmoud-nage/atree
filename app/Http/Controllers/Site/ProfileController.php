<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Order;
use App\Models\Follower;
use App\Models\UserDesign;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('site.profile' , compact('user'));
    }


    public function wishlist()
    {
        return view('site.wishlist');
    }

    public function followers()
    {
        $followers = Follower::with('user')->where('designer_id' , '='  , Auth::id())->get();
        return view('site.followers' , compact('followers') );
    }

    public function my_designs()
    {
        $records = UserDesign::where('user_id' , '='  , Auth::id())->with('products', 'user')->latest()->get();
        return view('site.my_designs' , compact('records') );
    }


    public function orders()
    {
        $records = Order::where('user_id', auth()->id())->latest()->get();
        return view('site.orders', compact('records'));
    }
    public function track_order($order_id)
    {
        $record = Order::findOrFail($order_id);
        return view('site.track_order', compact('record'));
    }


    public function diamond()
    {
        return view('site.diamonds');
    }

}
