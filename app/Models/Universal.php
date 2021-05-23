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
    public static function selectTableJoin($table, $table2,$fields){
        $select = 'select '.implode ( ',' , $fields).' from hris.'.$table . ' as A join hris.'.$table2 .' as B on A.id = B.'.$table . '_id where B.deleted_at is null and A.company_id ='.Session::get('company');
        $var_table = DB::select($select);
        return $var_table;
    }
    public static function getEmployeeProfile(){
        $employee = "select e.id ,b.name as branch, b.id as branch_id,d.id as department_id,c.id as cost_id,es.id as status_id,p.id as pos_id, employee_number, lastname, firstname, middlename, b.name as branch ,d.name as department , c.name as cost_centers, p.name as position, basic_pay, vacation_leave, sick_leave,  hiring_date, es.name as status
            from hris.employees as e join hris.branch as b on b.id =  e.branch_id 
            join hris.department as d on d.id = e.department_id
            join hris.cost_centers as c on c.id = e.cost_centers_id
            join hris.employee_status as es on es.id = e.status_id
            join hris.employee_position as p on p.id = e.position_id where e.deleted_at is null and e.company_id = ".Session::get('company');
        $var_table = DB::select($employee);
        
        return $var_table;
    }

}
