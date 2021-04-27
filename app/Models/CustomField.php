<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;
use Illuminate\Support\Facades\DB;
use Session;
class CustomField extends Model
{
    protected $table = 'custom_fields'; 
    protected $primaryKey = 'field_id';

    public static function getFields($table,$company){
        $fields = DB::select("select a.company_id, a.field_type, a.field_name,b.custom_value from hris.custom_fields a join hris.custom_values b on a.field_id=b.custom_id where a.field_table ='".$table."' and a.deleted_at is null and company_id =".$company);
        
        $fields_html = array();
        foreach($fields as $field){
            $company_id = $field->company_id;
            if($field->field_type == "area"){
                $html_code = [$company_id,"<label>".$field->field_name."</label>","<textarea class='mt-2 form-control' name='".$field->field_name."'></textarea>"];
            }if($field->field_type == "email"){
                $html_code = [$company_id,"<label>".$field->field_name."</label>","<input value='' type = 'email' class='mt-2 form-control' name='".$field->field_name."'>"];
            }if($field->field_type == "text"){
                $html_code = [$company_id,"<label>".$field->field_name."</label>","<input value='' type = 'text' class='mt-2 form-control' name='".$field->field_name."'>"];     
            }
            
            array_push($fields_html, $html_code);
        }
        return $fields_html;
    }
    public static function getFieldsValue($table){
        $fields = DB::select("select a.company_id, a.field_type, a.field_name,b.custom_value from hris.custom_fields a join hris.custom_values b on a.field_id=b.custom_id where a.field_table ='".$table."' and a.deleted_at is null and company_id =".Session::get('company'));
        return $fields;
    }
    public static function lastID(){
        $id="";
        $fields = DB::select("select TOP 1 field_id from hris.custom_fields ORDER BY field_id DESC");
        foreach($fields as $field){
            $id=$field->field_id;
        }
        return $id;
    }
}
