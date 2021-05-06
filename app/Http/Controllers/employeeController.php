<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class employeeController extends Controller
{
    public function index(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee = Universal::selectTable('employee');
            $fields_value = CustomField::getFieldsValue('employee');
            $fields = Company::getCompanyFields('employee');
            return view('user.settings.employee',compact('edit_roles','employee','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function index_status(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee_status = Universal::selectTable('employee_status');
            $fields_value = CustomField::getFieldsValue('employee_status');
            $fields = Company::getCompanyFields('employee_status');
            return view('user.settings.employee-status',compact('edit_roles','employee_status','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function index_position(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee_position = Universal::selectTable('employee_position');
            $fields_value = CustomField::getFieldsValue('employee_position');
            $fields = Company::getCompanyFields('employee_position');
            return view('user.settings.employee-position',compact('edit_roles','employee_position','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
