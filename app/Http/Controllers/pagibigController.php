<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class pagibigController extends Controller
{
    public function index(){
        if(User::hasRole('pagibig-edit') || User::hasRole('pagibig-view') ){
            if(User::hasRole('pagibig-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $pagibig = Universal::selectTable('pagibig');
            $fields_value = CustomField::getFieldsValue('pagibig');
            $fields = Company::getCompanyFields('pagibig');
            return view('user.pagibig',compact('edit_roles','pagibig','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
