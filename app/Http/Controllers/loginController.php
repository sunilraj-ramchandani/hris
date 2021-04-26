<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class loginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function view(Request $request)
    {
        $user = User::where('name',request('username'))->count();
        if($user > 0){
            $user_pass = DB::table('users')->where('name', request('username'))->pluck('password')->first();
            if(Hash::check(request('password'), $user_pass)){
                session(['user' => request('username')]);
                return redirect()->route('home');
            }else{
                Session::flush();
                $error_msg = "Username/Password Incorrect";
                return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
            }     
        }else{
            Session::flush();
            $error_msg = "Username doesn't Exist";
            return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
        }
        
        
    }public function logout(Request $request){
        Session::flush();
        return redirect()->route('login');
    }
}
