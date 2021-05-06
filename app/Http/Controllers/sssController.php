<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class sssController extends Controller
{
    public function index(){
        if(User::hasRole('sss-edit') || User::hasRole('sss-edit-view') ){
            if(User::hasRole('sss-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $sss = Universal::selectTable('sss');
            $fields_value = CustomField::getFieldsValue('sss');
            $fields = Company::getCompanyFields('sss');
            return view('user.sss',compact('edit_roles','sss','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
