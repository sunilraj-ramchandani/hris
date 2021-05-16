@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.company_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="company-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>address</th>
                <th>tin</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($company as $cmp)
            <tr>
                <td>{{$cmp->name}}</td>
                <td>{{$cmp->address}}</td>
                <td>{{$cmp->tin}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $cmp->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="edit_button btn btn-info" data-bs-toggle="modal" data-bs-target="#company" data-name="{{$cmp->name}}" data-address="{{$cmp->address}}" data-tin="{{$cmp->tin}}" data-id="{{$cmp->id}}"><i class="fa fa-edit"></i></button> 
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="company-add" data-bs-target="#delete_pop"  data-id="{{$cmp->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#company" style="color:white">Add New Company</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="company" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#company-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
    table.buttons().container().appendTo( $('#button_wrapper') );
});
</script>
@endsection