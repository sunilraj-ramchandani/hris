<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $table = 'custom_fields'; 
    protected $primaryKey = 'field_id';

    public static function getFields($table){
        $fields = CustomField::where('field_table',$table)->get();
        $fields_html = array();
        foreach($fields as $field){
            if($field->field_type = "text"){
                $html_code ="<input type = 'text' class='mt-2 form-control' value='".$field->field_value."' name='".$field->field_type."'>";     
            }else if($field->field_type = "email"){
                $html_code ="<input type = 'email' class='mt-2 form-control' value='".$field->field_value."' name='".$field->field_type."'>";
            }else if($field->field_type = "area"){
                $html_code ="<textarea class='mt-2 form-control' name='".$field->field_type."'>".$field->field_value."</textarea>";
            }
            array_push($fields_html, $html_code);
        }
        return $fields;
    }
}
