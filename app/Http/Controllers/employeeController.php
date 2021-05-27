<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Universal;
use App\Models\CustomField;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Session;

class employeeController extends Controller
{
    public function index(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee = Universal::getEmployeeProfile();
            $department = Universal::selectTable('department');
            $branch = Universal::selectTable('branch');
            $cost_centers = Universal::selectTable('cost_centers');
            $employee_position = Universal::selectTable('employee_position');
            $employee_status = Universal::selectTable('employee_status');
            $fields_value = CustomField::getFieldsValue('employees');
            $fields = Company::getCompanyFields('employees');
            return view('user.employee.employee',compact('employee_status','employee_position','cost_centers','branch','edit_roles','department','employee','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.employees(employee_number,lastname,firstname,middlename,department_id,branch_id,cost_centers_id,position_id,basic_pay,vacation_leave,sick_leave,status_id,hiring_date,created_by,updated_by,company_id) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[request('employee_number'),request('lastname'),request('firstname'),request('middlename'),request('department_id'),request('branch_id'),request('cost_centers_id'),request('position_id'),request('basic_pay'),request('vacation_leave'),request('sick_leave'),request('status_id'),request('hiring_date'),Session::get('user'),Session::get('user'),Session::get('company')]);
            $success_msg="Added Successfully!";
            return redirect()->route('employee')->with([ 'success_msg' => $success_msg ]);
        }else{
            if(request('employee_number')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.employees set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Deleted Successfully!";
                return redirect()->route('employee')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.employees set employee_number=?,lastname=?,firstname=?,middlename=?,position_id=?,status_id=?,updated_by=?,updated_at=? where id = ?',[request('employee_number'),request('lastname'),request('firstname'),request('middlename'),request('position_id'),request('status_id'),Session::get('user'),$updated_date,request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('employee')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
    public function index_status(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee_status = Universal::selectTable('employee_status');
            $fields_value = CustomField::getFieldsValue('employee_status');
            $fields = Company::getCompanyFields('employee_status');
            return view('user.settings.employee-status',compact('edit_roles','employee_status','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add_status(Request $request){
        if(is_null(request('exclude'))){
            $exclude = 0;
        }else{
            $exclude = 1;
        }
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.employee_status(name,description,exclude,created_by,updated_by,company_id) values (?,?,?,?,?,?)',[request('name'),request('desc'),$exclude,Session::get('user'),Session::get('user'),Session::get('company')]);
            $success_msg="Added Successfully!";
            return redirect()->route('employee-status')->with([ 'success_msg' => $success_msg ]);
        }else{
            if(request('name')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.employee_status set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Deleted Successfully!";
                return redirect()->route('employee-status')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.employee_status set name=?,description=?,exclude=?,updated_at=?,updated_by=? where id = ?',[request('name'),request('desc'),$exclude,$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('employee-status')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
    public function index_position(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee_position = Universal::selectTable('employee_position');
            $fields_value = CustomField::getFieldsValue('employee_position');
            $fields = Company::getCompanyFields('employee_position');
            return view('user.settings.employee-position',compact('edit_roles','employee_position','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add_position(Request $request){
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.employee_position(name,description,status,created_by,updated_by,company_id) values (?,?,?,?,?,?)',[request('name'),request('desc'),request('status'),Session::get('user'),Session::get('user'),Session::get('company')]);
            $success_msg="Added Successfully!";
            return redirect()->route('employee-position')->with([ 'success_msg' => $success_msg ]);
        }else{
            if(request('name')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.employee_position set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Deleted Successfully!";
                return redirect()->route('employee-position')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.employee_position set name=?,description=?,status=?,updated_at=?,updated_by=? where id = ?',[request('name'),request('desc'),request('status'),$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('employee-position')->with([ 'success_msg' => $success_msg ]);
            }
        }
    }
    public function index_emp_allowance(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $pay_settings = Universal::selectTable('pay_settings');
            $employee = Universal::selectTable('employees');
            $allowance = Universal::selectTable('allowance');
            $employee_allowance = Employee::employeeAllowanceDeduction('employees_allowance','employees','allowance',['b.id AS emp_id','c.id AS all_id','employee_number','a.id','firstname','status','lastname','middlename','c.name','a.amount','first_payout','second_payout','third_payout','fourth_payout']);
            $fields_value = CustomField::getFieldsValue('employees_allowance');
            $fields = Company::getCompanyFields('employees_allowance');
            return view('user.employee.employee-allowance',compact('pay_settings','allowance','employee','employee_allowance','fields_value','fields','edit_roles'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add_emp_allowance(Request $request){
        if($request->exists('first_payout')){
            $first_payout=1;
        }else{
            $first_payout=0;
        }
        
        if($request->exists('second_payout')){
            $second_payout=1;
        }else{
            $second_payout=0;
        }
        if($request->exists('third_payout')){
            $third_payout=1;
        }else{
            $third_payout=0;
        }
        if($request->exists('fourth_payout')){
            $fourth_payout=1;
        }else{
            $fourth_payout=0;
        }
        //dd($request);
        if(request('id')==''){
            $created_date = date("Y-m-d H:i:s");
            $insert = DB::insert('insert into hris.employees_allowance(employees_id,allowance_id,status,amount,first_payout,second_payout,third_payout,fourth_payout,company_id,created_by,updated_by) values (?,?,?,?,?,?,?,?,?,?,?)',[request('emp_id'),request('allowance'),request('status'),request('amount'),$first_payout,$second_payout,$third_payout,$fourth_payout,Session::get('company'),Session::get('user'),Session::get('user')]);
            $success_msg="Added Successfully!";
            return redirect()->route('employee-emp-allowance')->with([ 'success_msg' => $success_msg ]);
        }else{
            if(request('allowance')==''){
                $deleted_date = date("Y-m-d H:i:s");
                $delete=DB::update('update hris.employees_allowance set deleted_at=?, deleted_by=? where id=?',[$deleted_date,Session::get('user'),request('id')]);
                $success_msg="Deleted Successfully!";
                return redirect()->route('employee-emp-allowance')->with([ 'success_msg' => $success_msg ]);
            }else{
                $updated_date = date("Y-m-d H:i:s");
                $update =DB::update('update hris.employees_allowance set employees_id=?,allowance_id=?,status=?,amount=?,first_payout=?,second_payout=?,third_payout=?,fourth_payout=?,updated_at=?,updated_by=? where id = ?',[request('emp_id'),request('allowance'),request('status'),request('amount'),$first_payout,$second_payout,$third_payout,$fourth_payout,$updated_date,Session::get('user'),request('id')]);
                $success_msg="Updated Successfully!";
                return redirect()->route('employee-emp-allowance')->with([ 'success_msg' => $success_msg ]);
            }
        }
    } 
    public function index_emp_loan(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $pay_settings = Universal::selectTable('pay_settings');
            $employee = Universal::selectTable('employees');
            $loans = Universal::selectTable('loan');
            $employees_loan = $employee_allowance = Employee::employeeAllowanceDeduction('employees_loan','employees','loan',['b.id AS emp_id','c.id AS all_id','employee_number','a.id','firstname','lastname','middlename','months','c.name as loan','a.amount','first_payout','second_payout','third_payout','fourth_payout']);
            $fields_value = CustomField::getFieldsValue('employees_loan');
            $fields = Company::getCompanyFields('employees_loan');
            return view('user.employee.employee-loan',compact('pay_settings','loans','employee','employees_loan','fields_value','fields','edit_roles'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function index_emp_transfer(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee = Universal::getEmployeeProfile();
            $department = Universal::selectTable('department');
            $branch = Universal::selectTable('branch');
            $cost_centers = Universal::selectTable('cost_centers');
            $employee_position = Universal::selectTable('employee_position');
            $employee_status = Universal::selectTable('employee_status');
            $fields_value = CustomField::getFieldsValue('employees');
            $fields = Company::getCompanyFields('employees');
            return view('user.employee.employee-transfer',compact('employee_status','employee_position','cost_centers','branch','edit_roles','department','employee','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add_emp_transfer(Request $request){ 
        $created_date = date("Y-m-d H:i:s");
        $select_employee = Universal::selectTableID('employees',request('id'));
        $old_cost = "";
        $old_dept = "";
        $old_branch = "";
        $old_pay = "";
        foreach($select_employee as $employee){
            $old_branch = $employee->branch_id;
            $old_cost = $employee->cost_centers_id;
            $old_dept = $employee->department_id;
            $old_pay = $employee->basic_pay;
        }
        $insert = DB::insert('insert into hris.approver_employee(employees_id,cost_centers_id,department_id,branch_id,basic_pay,created_by,updated_by,company_id,status,cost_centers_id_from,department_id_from,branch_id_from,basic_pay_from) values (?,?,?,?,?,?,?,?,?,?,?,?,?)',[request('id'),request('cost_centers_id'),request('department_id'),request('branch_id'),request('basic_pay'),Session::get('user'),Session::get('user'),Session::get('company'),'Pending',$old_cost,$old_dept,$old_branch,$old_pay]);
        $success_msg="Added successfully, approver notified of the change";
        return redirect()->route('employee-transfer')->with([ 'success_msg' => $success_msg ]);
    }
    public function index_emp_increase(){
        if(User::hasRole('employee-edit') || User::hasRole('employee-view') ){
            if(User::hasRole('employee-edit')){
                $edit_roles = "edit";
            }else{
                $edit_roles = "view";
            }
            $employee = Universal::getEmployeeProfile();
            $department = Universal::selectTable('department');
            $branch = Universal::selectTable('branch');
            $cost_centers = Universal::selectTable('cost_centers');
            $employee_position = Universal::selectTable('employee_position');
            $employee_status = Universal::selectTable('employee_status');
            $fields_value = CustomField::getFieldsValue('employees');
            $fields = Company::getCompanyFields('employees');
            return view('user.employee.employee-increase',compact('employee_status','employee_position','cost_centers','branch','edit_roles','department','employee','fields_value','fields'));
        }else{
            Session::flush();
            $error_msg = "You are not allowed to access that module, you will now be signed out";
            return redirect()->route('login.get')->with([ 'error_msg' => $error_msg ]);
        }
    }
    public function add_emp_increase(Request $request){ 
        $created_date = date("Y-m-d H:i:s");
        $select_employee = Universal::selectTableID('employees',request('id'));
        $old_cost = "";
        $old_dept = "";
        $old_branch = "";
        $old_pay = "";
        foreach($select_employee as $employee){
            $old_branch = $employee->branch_id;
            $old_cost = $employee->cost_centers_id;
            $old_dept = $employee->department_id;
            $old_pay = $employee->basic_pay;
        }
        $insert = DB::insert('insert into hris.approver_employee(employees_id,cost_centers_id,department_id,branch_id,basic_pay,created_by,updated_by,company_id,status,cost_centers_id_from,department_id_from,branch_id_from,basic_pay_from) values (?,?,?,?,?,?,?,?,?,?,?,?,?)',[request('id'),$old_cost,$old_dept,$old_branch,request('basic_pay'),Session::get('user'),Session::get('user'),Session::get('company'),'Pending',$old_cost,$old_dept,$old_branch,$old_pay]);
        $success_msg="Added successfully, approver notified of the change";
        return redirect()->route('employee-increase')->with([ 'success_msg' => $success_msg ]);
    }
    
}
