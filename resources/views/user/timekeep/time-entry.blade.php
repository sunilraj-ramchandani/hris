@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.time_entry_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="entry-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Hours</th>
                <th>Type</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($time_entry as $time)
            <tr>
                <td>{{Carbon\Carbon::parse($time->timein)->format('F d, Y')}}</td>
                <td>{{Carbon\Carbon::parse($time->timein)->format('F d, Y g:sA')}}</td>
                <td>{{Carbon\Carbon::parse($time->timeout)->format('F d, Y g:sA')}}</td>
                <td>{{$time->hours}}</td>
                <td>{{$time->entry_type}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $time->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="edit_button btn btn-info" data-bs-toggle="modal" data-bs-target="#time_entry" data-id="{{$time->id}}" data-timeout="{{Carbon\Carbon::parse($time->timeout)->format('Y-m-d\TH:s')}}" data-timein="{{Carbon\Carbon::parse($time->timein)->format('Y-m-d\TH:s')}}" data-hours="{{$time->hours}}" data-entry_type="{{$time->entry_type}}"><i class="fa fa-edit"></i></button> 
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="time-entry-add" data-bs-target="#delete_pop"  data-id="{{$time->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info new-time" data-bs-toggle="modal" data-bs-target="#time_entry" style="color:white">Enter New Time</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="time_entry" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
$(document).ready(function() {
    var table = $('#entry-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
    table.buttons().container().appendTo( $('#button_wrapper') );
});
</script>
@endsection