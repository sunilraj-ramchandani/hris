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
            return view('user.settings.cost-centers',compact('edit_roles','cost','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
     public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.cost_centers (name,description,created_by,updated_by,company_id) values (?,?,?,?,?)',[request('name'),request('desc'),Session::get('user'),Session::get('user'),Session::get('id')]); 
            $success_msg="Added Successfully!";
            return redirect()->route('cost')->with([ 'success_msg' => $success_msg ]);
        }else{
             if(request('name')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.cost_centers set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Company Deleted Successfully!";
                
                return redirect()->route('cost')->with([ 'success_msg' => $success_msg ]);
             }
             else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.cost_centers set name = ? ,description= ? ,updated_at=?,updated_by=? where id = ?',[request('name'),request('desc'), $updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('cost')->with([ 'success_msg' => $success_msg ]);
             }
        } 
    }
}
