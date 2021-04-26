<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Setup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Session;

class settingsController extends Controller
{
    public function index(){
        if(User::getUser()->hasRole('setup-edit') || User::getUser()->hasRole('setup-view') ){
            $setups = Setup::all();
            if(User::getUser()->hasRole('setup-edit')){
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
            $setup = Setup::find($i);
            $setup->status = $status;
            $setup->save();
        }
        $success_msg = "Successfully updated system settings";
        return redirect()->route('settings')->with([ 'success_msg' => $success_msg ]);
    }
}
