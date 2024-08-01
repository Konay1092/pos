<?php

namespace App\Http\Controllers\admin\user;



use App\Http\Controllers\Controller;
use App\Models\User;




class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        // dd($users);
        return view('users.all_user', compact('users'));
    }
    public function userDetails($id)
    {
        $user = User::findOrFail($id);
        return view('users.userdetails', compact('user'));
    }
    public function deleteUser($id)
    {

        $user = User::findOrFail($id);
        if ($user->profile != null) {
            $img = $user->profile;
            unlink($img);
        }

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }
}
