<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Session;

class indexController extends Controller
{
    public function index()
    {
        if(Session::get('user')){
            return view('user.index'); 
        }else{
            return redirect()->route('login');
        }
        
    }
}
