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
            $time_keep = Universal::getTimeKeep();
            $branch = Universal::selectTable('branch');
            $cost = Universal::selectTable('cost_centers');
            $department = Universal::selectTable('department');
            $fields_value = CustomField::getFieldsValue('time_keep');
            $fields = Company::getCompanyFields('time_keep');
            $employees = Universal::getEmployeeProfile();
            return view('user.timekeep.time-keeping',compact('time_keep','employees','department','cost','branch','edit_roles','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }  
    public function add(){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.time_keep (date_from,date_to,branch_id,cost_center_id,department_id,created_by,updated_by,company_id,status) values (?,?,?,?,?,?,?,?,?)',[request('from'),request('to'),request('branch'),request('cost'),request('department'),Session::get('user'),Session::get('user'),Session::get('company'),"Pending"]);
            $success_msg="Time keep submitted, request sent to approver!";
            return redirect()->route('time-keeping')->with([ 'success_msg' => $success_msg ]);
        }else{
            $deleted_date = date("Y-m-d H:i:s");
            $delete=DB::update('update hris.time_keep set deleted_at=?, deleted_by=?, status=? where id=?',[$deleted_date,Session::get('user'),"Cancelled",request('id')]);
            $success_msg="Request cancelled!";
            return redirect()->route('time-keeping')->with([ 'success_msg' => $success_msg ]);
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
        $emp_id = "";
        $employee_details = Universal::selectTableWhere('employees','user_id',Session::get('id'));
        foreach($employee_details as $emp){
            $emp_id = $emp->id;
        }
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.time_entry (employees_id,timein,timeout,hours,entry_type,created_by,updated_by,company_id) values (?,?,?,?,?,?,?,?)',[$emp_id,Carbon::parse(request('timein'))->format('Y-m-d H:i:s'),Carbon::parse(request('timeout'))->format('Y-m-d H:i:s'),request('hours'),request('entry_type'),Session::get('user'),Session::get('user'),Session::get('company')]);
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
                $update =DB::update('update hris.time_entry set employees_id=?,timein=?,timeout=?,hours=?,entry_type=?,updated_at=?,updated_by=? where id = ?',[$emp_id,Carbon::parse(request('timein'))->format('Y-m-d H:i:s'),Carbon::parse(request('timeout'))->format('Y-m-d H:i:s'),request('hours') ,request('entry_type'),$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('time-entry')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
    public function index_emp_timekeep(Request $request){
        $holiday_dates = Universal::getTimeKeepDates($request->from,$request->to);
        $date_arrays= array();
        //SPECIAL HOLIDAYS
        $total_holidays = 0;
        foreach($holiday_dates as $dates){
            $time_keep_special_dates = Universal::selectTableSumDoubleWhere('time_entry','hours','CONVERT(date,timein)',$dates->holiday_date,'employees_id',$request->id,'=');
            foreach($time_keep_special_dates as $time_dates){
                array_push($date_arrays,array($dates->name,$time_dates->total));
                $total_holidays = $total_holidays + $time_dates->total;
            }
        }
        //REGULAR DAYS
        $time_keep_regular_dates = Universal::getRegularDays($request->id,$request->from,$request->to);
        foreach($time_keep_regular_dates as $time_dates){
            $total_regular = $time_dates->total - $total_holidays;
            array_push($date_arrays,array("Regular Days",$total_regular));
        }
        $html_code = "";
        for($i=0;$i<count($date_arrays);$i++){
            $html_code .= 
            '<div class="col-12 form-group mt-4">
                <label class="mb-2">'.$date_arrays[$i][0] .' (Hours)</label>
                <input readonly type = "text" class="mt-2 form-control" value="'.$date_arrays[$i][1].'">
            </div>';
        }
        

        return response()->json($html_code);
    }
}
