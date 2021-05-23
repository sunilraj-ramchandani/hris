<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class allowanceController extends Controller
{
    public function index(){
        if(User::hasRole('allowance-edit') || User::hasRole('allowance-view') ){
            if(User::hasRole('allowance-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $allowance = Universal::selectTable('allowance');
            $fields_value = CustomField::getFieldsValue('allowance');
            $fields = Company::getCompanyFields('allowance');
            return view('user.settings.allowance',compact('edit_roles','allowance','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add(){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.allowance(name,description,taxable,created_by,updated_by,company_id) values (?,?,?,?,?,?)',[request('name'),request('desc'),request('taxable'),Session::get('user'),Session::get('user'),Session::get('company')]);
            $success_msg="Added Successfully!";
            return redirect()->route('allowance')->with([ 'success_msg' => $success_msg ]);
        }else{
            if(request('name')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.allowance set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Deleted Successfully!";
                return redirect()->route('allowance')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.allowance set name=?,description=?,taxable=?,updated_at=?,updated_by=? where id = ?',[request('name'),request('desc'),request('taxable'),$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('allowance')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
}
