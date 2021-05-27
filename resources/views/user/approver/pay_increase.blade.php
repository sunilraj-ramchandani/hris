@extends('master')
@section('title', 'System Setup')

@section('content')

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
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="request-increase-add" data-bs-target="#delete_pop"  data-id="{{$cmp->id}}"><i class="fas fa-trash-alt"></i></button>
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
});
</script>
@endsection