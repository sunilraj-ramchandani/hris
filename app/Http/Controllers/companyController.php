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
        if(request('id')=='')
        {
             $created_date = date("Y-m-d H:i:s");
        $insert = DB::insert('insert into hris.company (name,address,created_by,updated_by,tin,created_at) values (?,?,?,?,?,?)', [request('name'), request('address'),Session::get('user'),Session::get('user'),request('tin'), $created_date]); 
           $error_msg = "Company Created, Login using the new company to finish setup";
        return redirect()->route('login')->with([ 'error_msg' => $error_msg ]);
        }
        else{
            if(request('name')=='')
            {
             $deleted_date = date("Y-m-d H:i:s");
             $delete=DB::update('update hris.company set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
              $success_msg="Company Deleted Successfully!";
              
           return redirect()->route('company')->with([ 'success_msg' => $success_msg ]);
            }
            else{
           $updated_date = date("Y-m-d H:i:s");
           $update =DB::update('update hris.company set name = ? ,address=?,update_at=?,tin=? where id = ?',[request('name'), request('address'),$updated_date,request('tin'),request('id')]);
           $success_msg="Updated Successfully!";
           return redirect()->route('company')->with([ 'success_msg' => $success_msg ]);
        }
     }
    }
}
