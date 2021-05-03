<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class departmentController extends Controller
{
    public function index(){
        if(User::hasRole('department-edit') || User::hasRole('department-view') ){
            if(User::hasRole('department-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $department = Universal::selectTable('department');
            $fields_value = CustomField::getFieldsValue('department');
            $fields = Company::getCompanyFields('department');
            return view('user.department',compact('edit_roles','department','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.department (name,created_by,created_at,company_id) values (?,?,?,?)',[request('address'),Session::get('user'),$created_date,Session::get('id')]); 
             $success_msg="Added Successfully!";
                return redirect()->route('department')->with([ 'success_msg' => $success_msg ]);
        }else{
             if(request('address')==''){
                  $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.department set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Company Deleted Successfully!";
                
                return redirect()->route('department')->with([ 'success_msg' => $success_msg ]);
             }
             else{
                  $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.department set name = ? ,updated_at=?,updated_by=? where id = ?',[request('address'), $updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('department')->with([ 'success_msg' => $success_msg ]);
             }
        } 
    }
}
