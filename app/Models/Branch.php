<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class Branch extends Model
{
    public static function getBranch(){
        $branch = DB::select('select * from hris.branch');
        return $branch;
    }
}
