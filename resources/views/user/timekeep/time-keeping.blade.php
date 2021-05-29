@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.time_keep_modals')
@include('modals.time_keep_employee_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="time-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Branch</th>
                <th>Cost Center</th>
                <th>Department</th>
                <th>Status</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($time_keep as $time)
            <tr>
                <td>{{Carbon\Carbon::parse($time->date_from)->format('F d, Y')}}</td>
                <td>{{Carbon\Carbon::parse($time->date_to)->format('F d, Y')}}</td>
               <!--Branch -->
                @if(is_null($time->branch))
                <td>All</td>
                @else
                <td>{{$time->branch}}</td>
                @endif
                <!--Cost Center -->
                @if(is_null($time->cost))
                <td>All</td>
                @else
                <td>{{$time->cost}}</td>
                @endif
                <!--Department-->
                @if(is_null($time->department))
                <td>All</td>
                @else
                <td>{{$time->department}}</td>
                @endif
                <td>{{$time->status}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $cmp->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    @if($time->status == "Pending")
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="time-keeping-add" data-bs-target="#delete_pop"  data-id="{{$time->id}}"><i class="fas fa-times"></i></button>
                    <button class="edit_button btn btn-info" data-bs-toggle="modal" data-bs-target="#view_time"  data-id="{{$time->id}}" data-from_date="{{$time->date_from}}" data-to_date="{{$time->date_to}}" data-id="{{$time->id}}"><i class="fas fa-eye"></i></button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#time-keep" style="color:white">Process New Time Keep</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="time-keep" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#time-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
    table.buttons().container().appendTo( $('#button_wrapper') );
    $('#emp_id').select2({
        tags: false,
        dropdownParent: $("#view_time")
    });
    
});
</script>
@endsection