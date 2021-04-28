<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use App\Models\CustomField;
use App\Models\Branch;
use App\Models\Company;

class branchController extends Controller
{
    public function index(){
        if(User::hasRole('branch-edit') || User::hasRole('branch-view') ){
            if(User::hasRole('branch-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $branch = Branch::getBranch();
            $fields_value = CustomField::getFieldsValue('branch');
            $fields = Company::getCompanyFields('branch');
            //dd($fields_value);
            return view('user.branch',compact('edit_roles','branch','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
