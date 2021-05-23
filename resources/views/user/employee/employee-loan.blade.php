@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.employee_loan_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="employee-loan-table">
        <thead>
            <tr>
                <th>Employee Number</th>
                <th>Full Name</th>
                <th>Loan Type</th>
                <th>Installment Plan</th>
                <th>Amount</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees_loan as $emp)
            <tr>
                <td>{{$emp->employee_number}}</td>
                <td>{{$emp->lastname}}, {{$emp->firstname}} {{$emp->middlename}}</td>
                <td>{{$emp->loan}}</td>
                <td>{{$emp->months}} Months</td>
                <td>{{number_format($emp->amount, 2, '.', ',')}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $emp->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="edit_button btn btn-info" data-emp_id="{{$emp->emp_id}}" data-amount="{{$emp->amount}}" data-loan="{{$emp->all_id}}" data-months="{{$emp->months}}" data-first_payout="{{$emp->first_payout}}" data-second_payout="{{$emp->second_payout}}" data-third_payout="{{$emp->third_payout}}" data-fourth_payout="{{$emp->fourth_payout}}" data-id="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#employees_loan"><i class="fa fa-edit"></i></button> 
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-bs-target="#employees_loan"  data-id="{{$emp->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#employees_loan" style="color:white">Add Loan to Employees</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="employees_loan" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#employee-loan-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
$(document).ready(function() {
    $('#emp_id').select2({
        tags: false,
        dropdownParent: $("#employees_loan")
    });
});
$(".edit_button").click(function() {
    $('#emp_id').val($(this).data("emp_id")); // Select the option with a value of '1'
    $('#emp_id').trigger('change'); 
    if($(this).data("first_payout") == 1){
        $('#first_payout').prop('checked',true);
    }else{
        $('#first_payout').prop('checked',false);
    }
    if($(this).data("second_payout") == 1){
        $('#second_payout').prop('checked',true);
    }else{
        $('#second_payout').prop('checked',false);
    }
    if($(this).data("third_payout") == 1){
        $('#third_payout').prop('checked',true);
    }else{
        $('#third_payout').prop('checked',false);
    }
    if($(this).data("fourth_payout") == 1){
        $('#fourth_payout').prop('checked',true);
    }else{
        $('#fourth_payout').prop('checked',false);
    }
});
</script>
@endsection