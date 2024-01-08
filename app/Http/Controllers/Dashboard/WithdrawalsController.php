<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawals;
use App\Models\Income;
use Auth;
class WithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.withdrawals.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawals $withdrawal)
    {
        $withdrawal->load('user');
        return view('dashboard.withdrawals.show' , compact('withdrawal') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawals $withdrawal)
    {
        $withdrawal->status= $request->status_id;
        $withdrawal->save();
        return redirect()->back()->with('success' , 'تم التعديل بنجاح' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Withdrawals $withdrawal)
    {
        $withdrawal->status = 3 ;
        $withdrawal->save();
        Income::where('user_id' , Auth::id() )->update(['withdrawn' => 1 ]);
        return redirect()->back()->with('success'  , 'تم الموافقه على الطلب بنجاح' );
    }


    public function deny(Withdrawals $withdrawal)
    {
        $withdrawal->status = 4 ;
        $withdrawal->save();
        return redirect()->back()->with('success'  , 'تم الموافقه رفض الطلب بنجاح' );
    }
}
