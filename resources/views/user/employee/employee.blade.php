@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.employee_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="employee-table">
        <thead>
            <tr>
                <th>Employee Number</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Department</th>
                <th>Branch</th>
                <th>Cost Center</th>
                <th>Position</th>
                <th>Basic Pay</th>
                <th>Vacation Leave (Days)</th>
                <th>Sick Leave (Days)</th>
                <th>Hiring Date</th>
                <th>Employee Status</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee as $emp)
            <tr>
                <td>{{$emp->employee_number}}</td>
                <td>{{$emp->lastname}}</td>
                <td>{{$emp->firstname}}</td>
                <td>{{$emp->middlename}}</td>
                <td>{{$emp->department}}</td>
                <td>{{$emp->branch}}</td>
                <td>{{$emp->cost_centers}}</td>
                <td>{{$emp->position}}</td>
                <td>{{$emp->basic_pay}}</td>
                <td>{{$emp->vacation_leave}}</td>
                <td>{{$emp->sick_leave}}</td>
                <td>{{$emp->hiring_date}}</td>
                <td>{{$emp->status}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $emp->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#employees" class="company_edit" ><i class="fa fa-edit"></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#employees"  data-id="{{$emp->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#employees" style="color:white">Add New Employee</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="employees" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#employee-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection