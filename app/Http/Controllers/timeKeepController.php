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
use App\Models\Company;

class timeKeepController extends Controller
{
    public function index(){
        if(User::hasRole('time-keep-edit') || User::hasRole('time-keep-view') ){
            if(User::hasRole('time-keep-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $fields_value = CustomField::getFieldsValue('time-keep');
            $fields = Company::getCompanyFields('time-keep');
            return view('user.timekeep.time-keeping',compact('edit_roles','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }    
    public function index_entry(){
        if(User::hasRole('time-keep-edit') || User::hasRole('time-keep-view') ){
            if(User::hasRole('time-keep-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee_details = Universal::selectTableWhere('employees','user_id',Session::get('id'));
            $time_entry = Universal::selectTable('time_entry');
            $fields_value = CustomField::getFieldsValue('time-keep');
            $fields = Company::getCompanyFields('time-keep');
            return view('user.timekeep.time-entry',compact('edit_roles','employee_details','time_entry','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add_entry(){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.time_entry (employees_id,timein,timeout,hours,entry_type,created_by,updated_by,company_id) values (?,?,?,?,?,?,?,?)',[request('emp_id'),Carbon::parse(request('timein'))->format('Y-m-d H:i:s'),Carbon::parse(request('timeout'))->format('Y-m-d H:i:s'),request('hours'),request('entry_type'),Session::get('user'),Session::get('user'),Session::get('company')]);
            $success_msg="Added Successfully!";
            return redirect()->route('time-entry')->with([ 'success_msg' => $success_msg ]);
        }else{
            if(request('timein')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.time_entry set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Deleted Successfully!";
                return redirect()->route('time-entry')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.time_entry set employees_id=?,timein=?,timeout=?,hours=?,entry_type=?,updated_at=?,updated_by=? where id = ?',[request('emp_id'),Carbon::parse(request('timein'))->format('Y-m-d H:i:s'),Carbon::parse(request('timeout'))->format('Y-m-d H:i:s'),request('hours') ,request('entry_type'),$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('time-entry')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
}
