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
            return view('user.holiday',compact('edit_roles','holiday','fields_value','fields'));
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
            return view('user.holiday-date',compact('edit_roles','holiday_date','holiday','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
}
