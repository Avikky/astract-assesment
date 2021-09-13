<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function success($email, $pwd)
    {
        $user_email = decrypt($email);
        $user = User::where('email', $user_email)->first();
        $password = decrypt($pwd);
        return view('success', compact('user', 'password'));
    }

    public function adminHome(){
        $users =  User::where('is_admin', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('users'));
    }

    public function activate(Request $request, $id){
        $user_id = decrypt($id);
        $user = User::find($user_id);
        $user->active = 1;
        $user->update();
        return back()->with('success', 'User has been activated');
    }

    public function deactivate(Request $request, $id){
        $user_id = decrypt($id);
        $user = User::find($user_id);
        $user->active = 0;
        $user->update();
        return back()->with('error', 'User has been deactivated');
    }
}
