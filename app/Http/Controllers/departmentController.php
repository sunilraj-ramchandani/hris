<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class departmentController extends Controller
{
    public function index(){
        if(User::hasRole('department-edit') || User::hasRole('department-view') ){
            if(User::hasRole('department-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $department = Universal::selectTable('department');
            $fields_value = CustomField::getFieldsValue('department');
            $fields = Company::getCompanyFields('department');
            return view('user.department',compact('edit_roles','department','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
