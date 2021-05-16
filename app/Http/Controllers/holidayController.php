<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class holidayController extends Controller
{
    public function index(){
        if(User::hasRole('holiday-edit') || User::hasRole('holiday-view') ){
            if(User::hasRole('holiday-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $holiday = Universal::selectTable('holiday');
            $fields_value = CustomField::getFieldsValue('holiday');
            $fields = Company::getCompanyFields('holiday');
            return view('user.settings.holiday',compact('edit_roles','holiday','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function index_date(){
        if(User::hasRole('holiday-edit') || User::hasRole('holiday-view') ){
            if(User::hasRole('holiday-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $holiday_date = Universal::selectTableJoin('holiday','holiday_date',['name','description','b.id','rate','holiday_date', 'status']);
            $holiday = Universal::selectTable('holiday');
            $fields_value = CustomField::getFieldsValue('holiday_date');
            $fields = Company::getCompanyFields('holiday_date');
            return view('user.settings.holiday-date',compact('edit_roles','holiday_date','holiday','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
   public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.holiday (name,description,rate,created_by,updated_by,company_id) values (?,?,?,?,?,?)',[request('name'),request('desc'),request('rate'),Session::get('user'),Session::get('user'),Session::get('id')]); 
             $success_msg="Added Successfully!";
                return redirect()->route('holiday')->with([ 'success_msg' => $success_msg ]);
        }else{
             if(request('name')==''){
                  $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.hris.holiday set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Company Deleted Successfully!";
                
                return redirect()->route('holiday')->with([ 'success_msg' => $success_msg ]);
             }
             else{
                  $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.hris.holiday set name=?,description=?,rate=?,updated_at=?,updated_by=? where id = ?',[request('name'),request('desc'),request('rate'),$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('holiday')->with([ 'success_msg' => $success_msg ]);
             }
        } 
    }
}
