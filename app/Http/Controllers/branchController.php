<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use App\Models\Universal;
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
            $branch = Universal::selectTable('branch');
            $fields_value = CustomField::getFieldsValue('branch');
            $fields = Company::getCompanyFields('branch');
            //dd($fields_value);
            return view('user.settings.branch',compact('edit_roles','branch','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
     public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.branch (name,address,created_by,updated_by,created_at,company) values (?,?,?,?,?,?)', [request('name'), request('address'),Session::get('user'),Session::get('user'), $created_date,Session::get('company')]); 
            $success_msg = "Bracnh Added Successfully!!!";
            return redirect()->route('branch')->with([ 'success_msg' => $success_msg ]);
        }
        else{
            if(request('name')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.branch set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Bracnh Deleted Successfully!";
              
                return redirect()->route('branch')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.branch set name = ? ,address=?,updated_at=? where id = ?',[request('name'), request('address'),$updated_date,request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('branch')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
}
