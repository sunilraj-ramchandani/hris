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
                <th>Department From</th>
                <th>Department To</th>
                <th>Branch From</th>
                <th>Branch To</th>
                <th>Cost Center From</th>
                <th>Cost Center To</th>
                <th>Status</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvals as $cmp)
            <tr>
                <td>{{$cmp->employee_number}}</td>
                <td>{{$cmp->lastname}}, {{$cmp->firstname}} {{$cmp->middlename}}</td>
                @if($cmp->department == $cmp->department_new)
                <td>No Change</td>
                <td>No Change</td>
                @else
                <td>{{$cmp->department}}</td>
                <td>{{$cmp->department_new}}</td>
                @endif
                @if($cmp->branch == $cmp->branch_new && $cmp->branch == $cmp->branch_new)
                <td>No Change</td>
                <td>No Change</td>
                @else
                <td>{{$cmp->branch}}</td>
                <td>{{$cmp->branch_new}}</td>
                @endif
                @if($cmp->cost_center == $cmp->cost_center_new)
                <td>No Change</td>
                <td>No Change</td>
                @else
                <td>{{$cmp->cost_center}}</td>
                <td>{{$cmp->cost_center_new}}</td>
                @endif
                <td>{{$cmp->status}}</td>
                @if($cmp->status == "Pending")
                <td>
                    <button class="edit_button btn btn-success" data-bs-toggle="modal" data-table="approval-transfer-add" data-bs-target="#approve"  data-id="{{$cmp->id}}" data-department_id="{{$cmp->department_id}}" data-emp_id ="{{$cmp->emp_id}}" data-branch_id="{{$cmp->branch_id}}" data-cost_centers_id="{{$cmp->cost_centers_id}}"><i class="fas fa-check"></i></button>
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="approval-transfer-add" data-bs-target="#delete_pop"  data-id="{{$cmp->id}}"><i class="fas fa-times"></i></button>
                </td>
                @else
                <td></td>
                @endif

            </tr>
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