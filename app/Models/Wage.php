<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class Wage extends Model
{
    public static function getWage(){
        $wage = DB::select('select * from hris.minimum_wage order by id ASC');
        return $wage;
    }

}
