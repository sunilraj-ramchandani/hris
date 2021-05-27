@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.approve_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="transfer-table">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>Basic Pay From</th>
                <th>Basic Pay To</th>
                <th>Status</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvals as $cmp)
            @if($cmp->basic_pay != $cmp->basic_pay_new)
            <tr>
                <td>{{$cmp->employee_number}}</td>
                <td>{{$cmp->lastname}}, {{$cmp->firstname}} {{$cmp->middlename}}</td>
                <td>{{number_format($cmp->basic_pay, 2, '.', ',')}}</td>
                <td>{{number_format($cmp->basic_pay_new, 2, '.', ',')}}</td>
                <td>{{$cmp->status}}</td>
                @if($cmp->status == "Pending")
                <td>
                    <button class="edit_button btn btn-success" data-bs-toggle="modal" data-table="approval-increase-add" data-bs-target="#approve"  data-id="{{$cmp->id}}" data-department_id="{{$cmp->department_id}}" data-basic_pay ="{{$cmp->basic_pay_new}}" data-emp_id ="{{$cmp->emp_id}}" data-branch_id="{{$cmp->branch_id}}" data-cost_centers_id="{{$cmp->cost_centers_id}}"><i class="fas fa-check"></i></button>
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="approval-increase-add" data-bs-target="#delete_pop"  data-id="{{$cmp->id}}"><i class="fas fa-times"></i></button>
                </td>
                @else
                <td></td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
    <hr>
</div>

<script>
  $(document).ready(function() {
    var table = $('#transfer-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
    table.buttons().container().appendTo( $('#button_wrapper') );
    $(".edit_button").click(function(){
        $('#approve #approve_modal').attr('action', $(this).data("table"));
    });
});
</script>
@endsection