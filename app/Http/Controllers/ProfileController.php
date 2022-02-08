<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePassword;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.profile.index');
    }

    public function changePassword(ChangePassword $request)
    {
        $user = Auth::guard('web')->user();
        
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->update();

            return redirect(route('profile'))->with('update', 'Updated Successfully');
        } else {
            return redirect(route('profile'))->with('error', 'Password is not correct');
        }
    }
}
