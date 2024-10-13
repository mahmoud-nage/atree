<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Coupons\StoreCouponRequest;
use App\Http\Requests\Dashboard\Coupons\UpdateCouponRequest;
use Auth;
use App\Models\Coupon;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request)
    {
        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->active = $request->filled('active') ? 1 : 0 ;
        $coupon->allowed_more_than_once_per_user = $request->filled('allowed_more_than_once_per_user') ? 1 : 0;
        $coupon->allow_times = $request->allow_times;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->user_id = Auth::id();
        $coupon->save();
        return redirect(route('dashboard.coupons.index'))->with('success', __('messages.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        $coupon->load('user');
        return view('dashboard.coupons.show' , compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit' , compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request,Coupon $coupon)
    {
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->active = $request->filled('active') ? 1 : 0 ;
        $coupon->allowed_more_than_once_per_user = $request->filled('allowed_more_than_once_per_user') ? 1 : 0;
        $coupon->allow_times = $request->allow_times;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save();
        return redirect(route('dashboard.coupons.index'))->with('success', __('messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
