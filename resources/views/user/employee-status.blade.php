@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.employee_status_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="employee-status-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Exclude from payroll?</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee_status as $emp)
            <tr>
                <td>{{$emp->name}}</td>
                <td>{{$emp->description}}</td>
                @if($emp->exclude == 1)
                <td>Yes</td>
                @else
                <td>No</td>
                @endif
                @foreach($fields_value as $val)
                    @if($val->company_id == $emp->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#employee_status" class="company_edit" data-id="{{$emp->id}}" data-name="{{$emp->name}}" data-exclude="{{$emp->exclude}}"><i class="fa fa-edit"></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#employee_status"  data-id="{{$emp->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#employee_status" style="color:white">Add New Employee Status</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="employee_status" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#employee-status-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection