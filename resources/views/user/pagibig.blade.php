@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.pagibig_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="pagibig-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Employee Rate</th>
                <th>Employer Rate</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagibig as $pagibg)
            <tr>
                <td>{{$pagibg->price_min}}</td>
                <td>{{$pagibg->price_max}}</td>
                <td>{{$pagibg->ee_rate}}</td>
                <td>{{$pagibg->er_rate}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $pagibg->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#pagibig" class="company_edit" data-er_rate="{{$pagibg->er_rate}}" data-ee_rate="{{$pagibg->ee_rate}}" data-id="{{$pagibg->id}}" data-from="{{$pagibg->price_min}}" data-to="{{$pagibg->price_max}}"><i class="fa fa-edit"></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#pagibig"  data-id="{{$pagibg->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#pagibig" style="color:white">Add New Pagibig</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="pagibig" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#pagibig-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection