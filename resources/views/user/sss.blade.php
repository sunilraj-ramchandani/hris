@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.sss_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="sss-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Employee Contribution</th>
                <th>Employee Compensation</th>
                <th>Employer Contribution</th>
                <th>Employer Compensation</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sss as $SSS)
            <tr>
                <td>{{$SSS->price_min}}</td>
                <td>{{$SSS->price_max}}</td>
                <td>{{$SSS->ee_contribution}}</td>
                <td>{{$SSS->ee_compensation}}</td>
                <td>{{$SSS->er_contribution}}</td>
                <td>{{$SSS->er_compesation}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $SSS->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#sss" class="company_edit" data-name="{{$SSS->name}}" data-id="{{$SSS->id}}"><i class="fa fa-edit"></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#sss"  data-id="{{$SSS->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#sss" style="color:white">Add New SSS</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="sss" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#sss-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection