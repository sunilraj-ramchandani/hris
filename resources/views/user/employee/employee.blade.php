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
                <th>Full Name</th>
                <th>Department</th>
                <th>Branch</th>
                <th>Cost Center</th>
                <th>Position</th>
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
                <td>{{$emp->lastname}}, {{$emp->firstname}} {{$emp->middlename}}</td>
                <td>{{$emp->department}}</td>
                <td>{{$emp->branch}}</td>
                <td>{{$emp->cost_centers}}</td>
                <td>{{$emp->position}}</td>
                <td>{{Carbon\Carbon::parse($emp->hiring_date)->format('F d, Y')}}</td>
                <td>{{$emp->status}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $emp->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button data-status_id="{{$emp->status_id}}" data-hiring_date="{{Carbon\Carbon::parse($emp->hiring_date)->format('F d, Y')}}" data-id="{{$emp->id}}" data-sick_leave="{{$emp->sick_leave}}" data-vacation_leave="{{$emp->vacation_leave}}" data-basic_pay="{{$emp->basic_pay}}" data-position="{{$emp->pos_id}}" data-cost_centers="{{$emp->cost_id}}" data-branch="{{$emp->branch_id}}" data-department="{{$emp->department_id}}" data-middlename="{{$emp->middlename}}" data-firstname="{{$emp->firstname}}" data-employee_number="{{$emp->employee_number}}" data-lastname="{{$emp->lastname}}" class="edit_button btn btn-info" data-bs-toggle="modal" data-bs-target="#employees"><i class="fa fa-edit"></i></button> 
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="employee-add" data-bs-target="#delete_pop" data-id="{{$emp->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#employees" id ="add_emp" style="color:white">Add New Employee</button>
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
 
    table.buttons().container().appendTo( $('#button_wrapper') );
    $("#add_emp").click(function() {
        $('#hiring_date').prop({type:"date"});
        $('#basic_pay').prop('readonly',false);
        $('#vacation_leave').prop('readonly',false);
        $('#sick_leave').prop('readonly',false);
        $('#hiring_date').prop('readonly',false);
    });
    $(".edit_button").click(function() {
        $('#basic_pay').prop('readonly',true);
        $('#vacation_leave').prop('readonly',true);
        $('#sick_leave').prop('readonly',true);
        $('#hiring_date').prop('readonly',true);
    });
} );
</script>
@endsection