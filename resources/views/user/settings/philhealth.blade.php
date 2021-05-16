@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.philhealth_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="philhealth-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Percent Rate</th>
                <th>Fixed Rate</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($philhealth as $phealth)
            <tr>
                <td>{{number_format($phealth->price_min, 2, '.', ',')}}</td>
                <td>{{number_format($phealth->price_max, 2, '.', ',')}}</td>
                <td>{{number_format($phealth->percent, 2, '.', ',')}}</td>
                <td>{{number_format($phealth->fixed, 2, '.', ',')}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $phealth->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="edit_button btn btn-info" data-bs-toggle="modal" data-bs-target="#phealth" data-id="{{$phealth->id}}" data-price_min="{{$phealth->price_min}}" data-price_max="{{$phealth->price_max}}" data-percent="{{$phealth->percent}}" data-fixed="{{$phealth->fixed}}"><i class="fa fa-edit" ></i></button> 
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="philhealth-add" data-bs-target="#delete_pop"  data-id="{{$phealth->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#phealth" style="color:white">Add New Philhealth</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="philhealth" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#philhealth-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection