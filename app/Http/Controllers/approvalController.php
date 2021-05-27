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

class approvalController extends Controller
{
    public function index_transfer(){
        $approvals = Universal::getApprover();
        $fields_value = CustomField::getFieldsValue('approver_employee');
        $fields = Company::getCompanyFields('approver_employee');
        return view('user.approver.transfers',compact('approvals','fields_value','fields'));
    }
    public function add_transfer(){
        $deleted_date = date("Y-m-d H:i:s");
        $delete=DB::update('update hris.approver_employee set deleted_at=?, deleted_by=?, status=? where id=?',[$deleted_date,Session::get('user'),'Cancelled',request('id')]);
        $success_msg="Deleted Successfully!";
        return redirect()->route('request-transfer')->with([ 'success_msg' => $success_msg ]);
    }
    public function index_approval_transfer(){
        $approvals = Universal::getApprover();
        $fields_value = CustomField::getFieldsValue('approver_employee');
        $fields = Company::getCompanyFields('approver_employee');
        return view('user.approver.approval_transfers',compact('approvals','fields_value','fields'));
    }
    public function add_approval_transfer(){
        if(request('approval')=='approval'){
            $update_date = date("Y-m-d H:i:s");
            $update= DB::update('update hris.approver_employee set updated_at=?, updated_by=?, status=?,department_id=?, branch_id=?, cost_centers_id=? where id=?',[$update_date,Session::get('user'),'Approved',request('department_id'),request('branch_id'),request('cost_centers_id'),request('id')]);
            $update_employee= DB::update('update hris.employees set updated_at=?, updated_by=?, department_id=?, branch_id=?, cost_centers_id=? where id=?',[$update_date,Session::get('user'),request('department_id'),request('branch_id'),request('cost_centers_id'),request('emp_id')]);
            $success_msg="Request Approved Successfully!";
        }else{
            $deleted_date = date("Y-m-d H:i:s");
            $delete= DB::update('update hris.approver_employee set deleted_at=?, deleted_by=?, status=? where id=?',[$deleted_date,Session::get('user'),'Disapproved',request('id')]);
            $success_msg="Deleted Successfully!";
        }
        return redirect()->route('approval-transfer')->with([ 'success_msg' => $success_msg ]);
    }
    public function index_increase(){
        $approvals = Universal::getApprover();
        $fields_value = CustomField::getFieldsValue('approver_employee');
        $fields = Company::getCompanyFields('approver_employee');
        return view('user.approver.pay_increase',compact('approvals','fields_value','fields'));
    }
    public function add_increase(){
        $deleted_date = date("Y-m-d H:i:s");
        $delete=DB::update('update hris.approver_employee set deleted_at=?, deleted_by=?, status=? where id=?',[$deleted_date,Session::get('user'),'Cancelled',request('id')]);
        $success_msg="Deleted Successfully!";
        return redirect()->route('request-increase')->with([ 'success_msg' => $success_msg ]);
    }
    public function index_approval_increase(){
        $approvals = Universal::getApprover();
        $fields_value = CustomField::getFieldsValue('approver_employee');
        $fields = Company::getCompanyFields('approver_employee');
        return view('user.approver.approval_pay_increase',compact('approvals','fields_value','fields'));
    }
    public function add_approval_increase(){
        if(request('approval')=='approval'){
            $update_date = date("Y-m-d H:i:s");
            $update= DB::update('update hris.approver_employee set updated_at=?, updated_by=?, status=?,department_id=?, branch_id=?, cost_centers_id=? where id=?',[$update_date,Session::get('user'),'Approved',request('department_id'),request('branch_id'),request('cost_centers_id'),request('id')]);
            $update_employee= DB::update('update hris.employees set updated_at=?, updated_by=?, basic_pay=? where id=?',[$update_date,Session::get('user'),request('basic_pay'),request('emp_id')]);
            $success_msg="Request Approved Successfully!";
        }else{
            $deleted_date = date("Y-m-d H:i:s");
            $delete= DB::update('update hris.approver_employee set deleted_at=?, deleted_by=?, status=? where id=?',[$deleted_date,Session::get('user'),'Disapproved',request('id')]);
            $success_msg="Deleted Successfully!";
        }
        return redirect()->route('approval-increase')->with([ 'success_msg' => $success_msg ]);
    }
    
}
