<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class sssController extends Controller
{
    public function index(){
        if(User::hasRole('sss-edit') || User::hasRole('sss-edit-view') ){
            if(User::hasRole('sss-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $sss = Universal::selectTable('sss');
            $fields_value = CustomField::getFieldsValue('sss');
            $fields = Company::getCompanyFields('sss');
            return view('user.sss',compact('edit_roles','sss','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
     public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.sss (price_min,price_max,ee_contribution,er_contribution,ee_compensation,er_compesation,created_by,created_at,company_id) values (?,?,?,?,?,?,?,?,?)',[request('price_min'),request('price_max'),request('ee_contribution'),request('er_contribution'),request('ee_compensation'),request('er_compensation'),Session::get('user'),$created_date,Session::get('id')]); 
             $success_msg="Added Successfully!";
                return redirect()->route('sss')->with([ 'success_msg' => $success_msg ]);
        }else{
             if(request('price_min')==''){
                  $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.sss set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Company Deleted Successfully!";
                
                return redirect()->route('sss')->with([ 'success_msg' => $success_msg ]);
             }
             else{
                  $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.sss set price_min=?,price_max =?,ee_contribution=?,er_contribution=?,ee_compensation=?,er_compesation=?,updated_at=?,updated_by=? where id = ?',[request('price_min'),request('price_max'),request('ee_contribution'),request('er_contribution') ,request('ee_compensation') ,request('er_compensation') ,$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('sss')->with([ 'success_msg' => $success_msg ]);
             }
        } 
    }
}
