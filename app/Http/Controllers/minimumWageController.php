<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wage;
use App\Models\Universal;
use Illuminate\Support\Facades\DB;
use Session;

class minimumWageController extends Controller
{
    public function index(){
        if(User::hasRole('wage-edit') || User::hasRole('wage-view') ){
            if(User::hasRole('wage-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $wage = Universal::selectTable('minimum_wage');
            return view('user.wage',compact('edit_roles','wage'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
