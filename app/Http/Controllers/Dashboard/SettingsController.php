<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Storage;
class SettingsController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit()
    {
        $info = Settings::first();
        return view('dashboard.settings.edit', compact('info') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $info = Settings::first();
        $info->setTranslation('about_us' , 'ar' , $request->about_us_ar );
        $info->setTranslation('about_us' , 'en' , $request->about_us_en );
        $info->email = $request->email;
        $info->phone = $request->phone;
        $info->facebook = $request->facebook;
        $info->twitter = $request->twitter;
        $info->instgrame = $request->instgrame;
        $info->lat = $request->latitude;
        $info->long = $request->longitude;
        $info->android_link = $request->android_link;
        $info->ios_link = $request->ios_link;
        $info->vat = $request->vat;
        $info->maroof = $request->maroof;
        $info->point_equal_money = $request->point_equal_money;
        $info->minimam_money_can_be_withdrawal = $request->minimam_money_can_be_withdrawal;
        $info->days_to_valid_marketer_money = $request->days_to_valid_marketer_money;
        if ($request->hasFile('logo')) {
            $info->logo =  basename($request->file('logo')->store('settings'));
        }
        if ($request->hasFile('user_default_image')) {
           $user_default_image = basename($request->file('user_default_image')->store('users'));
           Storage::delete('users/user-default.png');
           Storage::move('users/'.$user_default_image, 'users/user-default.png');
        }
        $info->save();
        return redirect()->back()->with('success', __('messages.updated_successfully'));
    }


}
