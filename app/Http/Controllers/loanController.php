<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class loanController extends Controller
{
    public function index(){
        if(User::hasRole('loan-edit') || User::hasRole('loan-view') ){
            if(User::hasRole('loan-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $loan = Universal::selectTable('loan');
            $fields_value = CustomField::getFieldsValue('loan');
            $fields = Company::getCompanyFields('loan');
            return view('user.settings.loan',compact('edit_roles','loan','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
