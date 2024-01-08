<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Challenges\StoreChallengeRequest;
use App\Http\Requests\Dashboard\Challenges\UpdateChallengeRequest;

use App\Models\Challenge;
use Auth;
class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.challenges.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.challenges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChallengeRequest $request)
    {
        $challenge = new Challenge;
        $challenge->title = $request->title;
        $challenge->user_id = Auth::id();
        $challenge->orders = $request->orders;
        $challenge->money = $request->money;
        $challenge->starts_at = $request->starts_at;
        $challenge->ends_at = $request->ends_at;
        $challenge->color = $request->color;
        $challenge->is_active = $request->filled('is_active') ? 1 : 0;
        $challenge->should_user_finishes_to_receive_money = $request->filled('should_user_finishes_to_receive_money') ? 1 : 0;
        $challenge->save();

        return redirect(route('dashboard.challenges.index'))->with('success' , 'تم إنشاء التحدى بنجاح' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        return view('dashboard.challenges.show' , compact('challenge') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        return view('dashboard.challenges.edit' , compact('challenge') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChallengeRequest $request, Challenge $challenge)
    {
        $challenge->title = $request->title;
        $challenge->orders = $request->orders;
        $challenge->money = $request->money;
        $challenge->starts_at = $request->starts_at;
        $challenge->ends_at = $request->ends_at;
        $challenge->color = $request->color;
        $challenge->is_active = $request->filled('is_active') ? 1 : 0;
        $challenge->should_user_finishes_to_receive_money = $request->filled('should_user_finishes_to_receive_money') ? 1 : 0;
        $challenge->save();

        return redirect(route('dashboard.challenges.index'))->with('success' , 'تم تعديل  التحدى بنجاح' );
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
