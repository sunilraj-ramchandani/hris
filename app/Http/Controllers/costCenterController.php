<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class costCenterController extends Controller
{
    public function index(){
        if(User::hasRole('cost-center-edit') || User::hasRole('cost-center-edit-view') ){
            if(User::hasRole('cost-center-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $cost = Universal::selectTable('cost_centers');
            $fields_value = CustomField::getFieldsValue('cost_centers');
            $fields = Company::getCompanyFields('cost_centers');
            return view('user.cost-centers',compact('edit_roles','cost','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
