<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Setup;
use App\Models\CustomField;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Session;

class settingsController extends Controller
{
    public function index(){
        if(User::hasRole('setup-edit') || User::hasRole('setup-view') ){
            $setups = Setup::getAll();
            if(User::hasRole('setup-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            return view('user.settings',compact('setups','edit_roles'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function update(Request $request){
        $status = 0;
        for($i=1;$i < 13;$i++){
            $status = 0;
            if(request($i) == "on"){
                $status = 1;
            }else{
                $status = 0;
            }
            $setup = Setup::update_table($status,$i);
        }
        $success_msg = "Successfully updated system settings";
        return redirect()->route('settings')->with([ 'success_msg' => $success_msg ]);
    }
}
