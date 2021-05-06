@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.holiday_date_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="holiday-date-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Rate</th>
                <th>Date</th>
                <th>Status</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holiday_date as $date)
            <tr>
                <td>{{$date->name}}</td>
                <td>{{$date->description}}</td>
                <td>{{$date->rate}}</td>
                <td>{{$date->holiday_date}}</td>
                <td>{{$date->status}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $date->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#holiday_date" class="company_edit" data-id="{{$date->id}}" data-holiday_date="{{$date->holiday_date}}" data-status="{{$date->status}}"><i class="fa fa-edit"></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#holiday_date"  data-id="{{$holi->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#holiday_date" style="color:white">Add New Holiday Dates</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="holiday_date" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#holiday-date-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection