<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomField;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Session;

class companyController extends Controller
{
    public function index(){
        if(User::getUser()->hasRole('company-edit') || User::getUser()->hasRole('company-view') ){
            if(User::getUser()->hasRole('company-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $fields = CustomField::getFields('company');
            return view('user.company',compact('edit_roles','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
