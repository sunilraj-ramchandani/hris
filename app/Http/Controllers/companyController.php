<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class companyController extends Controller
{
    public function index(){
        if(User::hasRole('company-edit') || User::hasRole('company-view') ){
            if(User::hasRole('company-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $company = Company::getCompany();
            $fields_value = CustomField::getFieldsValue('company');
            $fields = Company::getCompanyFields();
            //dd($fields_value);
            return view('user.company',compact('edit_roles','company','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add(Request $request){
        $insert = DB::insert('insert into hris.company (name,address,created_by,updated_by,tin) values (?,?,?,?,?)', [request('name'), request('address'),Session::get('user'),Session::get('user'),request('tin')]);
        $error_msg = "Company Created, Login using the new company to finish setup";
        return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
    }
}
