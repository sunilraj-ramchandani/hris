<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Session;

class Universal extends Model
{
    
    public static function selectTable($table){
        $select = 'select * from hris.'.$table . ' where deleted_at is null and company_id ='.Session::get('company');
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function selectTableID($table,$id){
        $select = 'select * from hris.'.$table . ' where deleted_at is null and company_id ='.Session::get('company') .' and id ='.$id;
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function selectTableWhere($table,$where,$answer){
        $select = 'select * from hris.'.$table . ' where deleted_at is null and company_id ='.Session::get('company') .' and '.$where.' ='.$answer;
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function selectTableSumWhere($table,$sum,$where,$answer,$operand){
        $select = "select ISNULL(sum(".$sum."),0) as total from hris.".$table . " where deleted_at is null and company_id =".Session::get("company") ." and ".$where." ".$operand." '".$answer."'";
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function selectTableSumDoubleWhere($table,$sum,$where,$answer,$where2,$answer2,$operand){
        $select = "select ISNULL(sum(".$sum."),0) as total from hris.".$table . " where deleted_at is null and company_id =".Session::get("company") ." and ".$where." ".$operand." '".$answer."' and ".$where2." ".$operand." '".$answer2."'";
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function getRegularDays($id,$from,$to){
        $select = "select ISNULL(sum(hours),0) as total from hris.time_entry where deleted_at is null and company_id =".Session::get("company") ." and employees_id = ".$id." and CONVERT(date,timein) >= '".$from."' and CONVERT(date,timein) <= '".$to."'";
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function selectTableJoin($table, $table2,$fields){
        $select = 'select '.implode ( ',' , $fields).' from hris.'.$table . ' as A join hris.'.$table2 .' as B on A.id = B.'.$table . '_id where B.deleted_at is null and A.company_id ='.Session::get('company');
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function getTimeKeepDates($from, $to){
        $select = "select a.name, a.rate, b.holiday_date from hris.holiday as a join hris.holiday_date as b on a.id = b.holiday_id where b.deleted_at is null and b.company_id =".Session::get("company") . " and b.holiday_date >= '".$from."' and b.holiday_date <= '".$to."'";
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function getTimeKeep(){
        $select = 'select a.id, date_from, date_to, b.name as branch,b.id as bid, c.name as cost,c.id as cid, d.name as department,d.id as did, a.status 
        from hris.time_keep as a
        LEFT join hris.branch as b on a.branch_id = b.id 
        LEFT join hris.cost_centers as c on a.cost_center_id = c.id
        LEFT join hris.department as d on a.department_id = d.id
        where a.company_id='.Session::get('company');
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function getApprover(){
        $employee = "select a.status, a.department_id,a.cost_centers_id,a.branch_id
        ,a.deleted_at, a.id,b.employee_number,b.lastname,b.firstname,b.middlename, b.id as emp_id
        ,c.name as branch,d.name as branch_new
        ,e.name as cost_center,f.name as cost_center_new
        ,g.name as department, h.name as department_new,a.basic_pay_from as basic_pay, a.basic_pay as basic_pay_new 
        from 
        hris.approver_employee as a
        join hris.employees as b on a.employees_id = b.id
        join hris.branch as c on a.branch_id_from = c.id
        join hris.branch as d on a.branch_id = d.id
        join hris.cost_centers as e on a.cost_centers_id_from = e.id
        join hris.cost_centers as f on a.cost_centers_id = f.id
        join hris.department as g on a.department_id_from = g.id
        join hris.department as h on a.department_id = h.id
        where a.company_id =".Session::get('company');
        $var_table = DB::select($employee); 
        return $var_table;
    }
    public static function getEmployeeProfile(){
        $employee = "select e.id,b.name as branch, b.id as branch_id,d.id as department_id,c.id as cost_id,es.id as status_id,p.id as pos_id, employee_number, lastname, firstname, middlename, b.name as branch ,d.name as department , c.name as cost_centers, p.name as position, basic_pay, vacation_leave, sick_leave,  hiring_date, es.name as status
            from hris.employees as e join hris.branch as b on b.id =  e.branch_id 
            join hris.department as d on d.id = e.department_id
            join hris.cost_centers as c on c.id = e.cost_centers_id
            join hris.employee_status as es on es.id = e.status_id
            join hris.employee_position as p on p.id = e.position_id where e.deleted_at is null and e.company_id = ".Session::get('company');
        $var_table = DB::select($employee); 
        return $var_table;
    }

}
