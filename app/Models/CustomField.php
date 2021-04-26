<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;
use Illuminate\Support\Facades\DB;

class CustomField extends Model
{
    protected $table = 'custom_fields'; 
    protected $primaryKey = 'field_id';

    public static function getFields($table){
        $fields = DB::table('custom_fields')
        ->select('custom_fields.field_type','custom_fields.field_name','custom_values.custom_value')
        ->join('custom_values', 'custom_fields.field_id', '=', 'custom_values.custom_id')
        ->where('custom_fields.field_table', "$table")
        ->where('custom_fields.deleted_at', null)
        ->get();
        $fields_html = array();
        foreach($fields as $field){
            if($field->field_type = "text"){
                $html_code ="<input value='".$field->custom_value."' type = 'text' class='mt-2 form-control' name='".$field->field_name."'>";     
            }else if($field->field_type = "email"){
                $html_code ="<input value='".$field->custom_value."' type = 'email' class='mt-2 form-control' name='".$field->field_name."'>";
            }else if($field->field_type = "area"){
                $html_code ="<textarea class='mt-2 form-control' name='".$field->field_name."'>".$field->custom_value."</textarea>";
            }
            array_push($fields_html, $html_code);
        }
        return $fields_html;
    }
}
