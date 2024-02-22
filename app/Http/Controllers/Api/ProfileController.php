<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Order;
use App\Models\Follower;
use App\Models\Wishlist;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    use ApiResponse;

    public function wishlist()
    {
        $records = Wishlist::with('user')->where('user_id',  Auth::id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records, false);
    }

    public function followers()
    {
        $records = Follower::with('user')->where('designer_id', '=', Auth::id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records, false);
    }

    public function my_designs()
    {
        $records = Design::where('user_id', '=', Auth::id())->with('products', 'user')->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records, false);
    }


    public function orders()
    {
        $records = Order::where('user_id', auth()->id())->get();
        return self::makeSuccess(Response::HTTP_OK, '', $records, false);
    }

    public function track_order($order_id)
    {
        $record = Order::findOrFail($order_id);
        return self::makeSuccess(Response::HTTP_OK, '', $record, false);
    }


}
