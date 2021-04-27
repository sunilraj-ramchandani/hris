<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class Company extends Model
{
    protected $table = 'custom_fields'; 
    protected $primaryKey = 'field_id';

    public static function getCompany(){
        $company = DB::select('select * from hris.company');
        return $company;
    }
    public static function getCompanyFields(){
        $company = DB::select('select * from hris.company');
        $field_collection = array();
        foreach($company as $cmp){
            $fields = CustomField::getFields('company',$cmp->id);
            array_push($field_collection,$fields);
        }
        
        return $field_collection;
    }

}
