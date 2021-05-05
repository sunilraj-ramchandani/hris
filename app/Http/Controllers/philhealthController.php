<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class philhealthController extends Controller
{
    public function index(){
        if(User::hasRole('philhealth-edit') || User::hasRole('philhealth-edit-view') ){
            if(User::hasRole('philhealth-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $philhealth = Universal::selectTable('philhealth');
            $fields_value = CustomField::getFieldsValue('philhealth');
            $fields = Company::getCompanyFields('philhealth');
            return view('user.philhealth',compact('edit_roles','philhealth','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
