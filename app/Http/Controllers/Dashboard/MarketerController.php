<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Marketers\StoreMarketerRequest;
use App\Http\Requests\Dashboard\Marketers\UpdateMarketerRequest;
use Auth;
use Hash;
use App\Models\User;
class MarketerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.marketers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.marketers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarketerRequest $request)
    {
        $user = new User;
        $user->user_id = Auth::id();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->type = User::MARKETER;
        $user->password  = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $user->image = basename($request->file('image')->store('users'));
        }
        $user->save();
        flash()->addSuccess('تم إضافه المسوق بنجاح');
        return redirect(route('dashboard.marketers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $marketer)
    {
        return view('dashboard.marketers.show' , compact('marketer') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $marketer)
    {
        return view('dashboard.marketers.edit' , compact('marketer') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarketerRequest $request, User $marketer)
    {
        $marketer->email = $request->email;
        $marketer->name = $request->name;
        $marketer->phone = $request->phone;
        if ($request->hasFile('image')) {
            $marketer->image = basename($request->file('image')->store('users'));
        }
        $marketer->save();
        flash()->addSuccess('تم تعديل بينات  المسوق بنجاح');
        return redirect(route('dashboard.marketers.index'));
    }


    public function statistics(User $marketer)
    {
        return view('dashboard.marketers.statistics' , compact('marketer'));
    }

    public function orders(User $marketer)
    {
        return view('dashboard.marketers.orders' , compact('marketer'));
    }

    public function withdrawals(User $marketer)
    {
        return view('dashboard.marketers.withdrawals' , compact('marketer'));
    }


    public function login(User $marketer) {

        Auth::login($marketer);

        return redirect(route('site.account'))->with('success' , 'تم تسجيل الدخول ببيانات المسوق بنجاح' );

    }

}
