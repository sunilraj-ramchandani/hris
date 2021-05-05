<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class taxController extends Controller
{
    public function index(){
        if(User::hasRole('tax-edit') || User::hasRole('tax-edit-view') ){
            if(User::hasRole('tax-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $tax_classifications = Universal::selectTable('tax_classifications');
            $fields_value = CustomField::getFieldsValue('tax_classifications');
            $fields = Company::getCompanyFields('tax_classifications');
            return view('user.tax',compact('edit_roles','tax_classifications','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
