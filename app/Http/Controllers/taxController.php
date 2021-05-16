<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class taxController extends Controller
{
    public function index(){
        if(User::hasRole('tax-edit') || User::hasRole('tax-edit-view') ){
            if(User::hasRole('tax-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $tax_classifications = Universal::selectTable('tax_classifications');
            $fields_value = CustomField::getFieldsValue('tax_classifications');
            $fields = Company::getCompanyFields('tax_classifications');
            return view('user.settings.tax',compact('edit_roles','tax_classifications','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function index_rate(){
        if(User::hasRole('tax-edit') || User::hasRole('tax-edit-view') ){
            if(User::hasRole('tax-edit-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $tax_rate = Universal::selectTableJoin('tax_classifications','tax_rate',['name','description','b.id','price_min','price_max','rate']);
            $tax_classifications = Universal::selectTable('tax_classifications');
            $fields_value = CustomField::getFieldsValue('tax_rate');
            $fields = Company::getCompanyFields('tax_rate');
            return view('user.settings.tax-rate',compact('edit_roles','tax_rate','tax_classifications','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
     public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.tax_classifications (name,description,created_by,updated_by,company_id) values (?,?,?,?,?)',[request('name'),request('desc'),Session::get('user'),Session::get('user'),Session::get('id')]); 
            $success_msg="Added Successfully!";
            return redirect()->route('tax')->with([ 'success_msg' => $success_msg ]);
        }else{
             if(request('name')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.tax_classifications set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Company Deleted Successfully!";
                
                return redirect()->route('tax')->with([ 'success_msg' => $success_msg ]);
             }
             else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.tax_classifications set name=?,description=?,updated_at=?,updated_by=? where id = ?',[request('name'),request('desc'),$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('tax')->with([ 'success_msg' => $success_msg ]);
             }
        } 
    }
}
