<?php

namespace App\Http\Controllers;
use App\Models\CustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class customFieldController extends Controller
{
    public function update(Request $request){
        $succ_msg = "New field added to company";
        $last_id = CustomField::lastID();
        $insert_field = DB::insert('insert into hris.custom_fields (field_table, field_name,field_type,field_length,company_id,field_required,created_by,updated_by) values (?,?,?,?,?,?,?,?)', [request('field_table'),request('field_name'),request('field_type'),request('field_length'),Session::get('company'),1,'admin','admin']);
        $last_id = CustomField::lastID();
        $insert_value = DB::insert('insert into hris.custom_values (custom_id, custom_value,created_by,updated_by) values (?,?,?,?)', [$last_id,request('field_value'),'admin','admin']);
        return redirect()->route('company')->with(['success_msg' => $succ_msg ]);
    }
}
