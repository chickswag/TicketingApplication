<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            $userData = Auth::User();
            $role = Role::where('id', $userData['role_id'])->first();
            return view('dashboard',compact('userData','role'))->render();
        }
        else{
            return redirect()->back()->withErrors('');
        }

    }
}
