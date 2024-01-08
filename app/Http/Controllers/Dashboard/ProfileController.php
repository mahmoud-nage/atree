<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use App\Http\Requests\Dashboard\Profile\UpdatePasswordRequest;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile' , compact('user') );
    }


    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->hasFile('image')) {
            $user->image = basename($request->file('image')->store('admins'));
        }
        $user->save();
        return redirect()->back()->with('success' , 'تم تعديل بيانات الملف الشخصى بنجاح' );
    }


    public function password()
    {
        return view('dashboard.password');
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        if (!Hash::check($request->current_password, Auth::user()->password )) {
            return back()->with('error' , 'كلمه المرور الحاليه غير صحيحه' );
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success' , 'تم تعديل كلمه المرور بنجاح' );

    }


}
