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

    public function add(Request $request){
 
             $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.minimum_wage set price = ? ,region=?,updated_at=? where id = ?',[request('address'), request('name'),$updated_date,request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('wage')->with([ 'success_msg' => $success_msg ]);
            
        }
}
