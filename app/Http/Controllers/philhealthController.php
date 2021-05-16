<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class philhealthController extends Controller
{
    public function index(){
        if(User::hasRole('philhealth-edit') || User::hasRole('philhealth-edit-view') ){
            if(User::hasRole('philhealth-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $philhealth = Universal::selectTable('philhealth');
            $fields_value = CustomField::getFieldsValue('philhealth');
            $fields = Company::getCompanyFields('philhealth');
            return view('user.settings.philhealth',compact('edit_roles','philhealth','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
     public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.philhealth (price_min,price_max,[percent],fixed,created_by,updated_by,company_id) values (?,?,?,?,?,?,?)',[request('price_min'),request('price_max'),request('percent'),request('fixed'),Session::get('user'),Session::get('user'),Session::get('id')]); 
             $success_msg="Added Successfully!";
                return redirect()->route('philhealth')->with([ 'success_msg' => $success_msg ]);
        }else{
             if(request('price_min')==''){
                  $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.philhealth set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Company Deleted Successfully!";
                
                return redirect()->route('philhealth')->with([ 'success_msg' => $success_msg ]);
             }
             else{
                  $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.philhealth set price_min=?,price_max =?,[percent]=?,fixed=?,updated_at=?,updated_by=? where id = ?',[request('price_min'),request('price_max'),request('percent'),request('fixed') ,$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('philhealth')->with([ 'success_msg' => $success_msg ]);
             }
        
    }
}
}
