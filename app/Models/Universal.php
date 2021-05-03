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

}