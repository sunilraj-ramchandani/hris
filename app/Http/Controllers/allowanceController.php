<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class allowanceController extends Controller
{
    public function index(){
        if(User::hasRole('allowance-edit') || User::hasRole('allowance-view') ){
            if(User::hasRole('allowance-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $allowance = Universal::selectTable('allowance');
            $fields_value = CustomField::getFieldsValue('allowance');
            $fields = Company::getCompanyFields('allowance');
            return view('user.settings.allowance',compact('edit_roles','allowance','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
