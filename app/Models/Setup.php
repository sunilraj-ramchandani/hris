<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setup extends Model
{
    protected $table = 'setup_modules'; 
    protected $primaryKey = 'module_id';

    public static function getAll(){
        $setup = DB::select('select * from hris.setup_modules');
        return $setup;
    }
    public static function update_table($updated_value,$where){
        $setup_update = DB::update('update hris.setup_modules set status ='.$updated_value.'where module_id = ?',[$where]);
        return $setup_update;
    }
}
