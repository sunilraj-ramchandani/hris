@extends('master')
@section('title', 'System Setup')

@section('content')
<div class="container pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <table class="table table-bordered" id="company-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>address</th>
                <th>tin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($company as $cmp)
            <tr>
                <td>{{$cmp->name}}</td>
                <td>{{$cmp->address}}</td>
                <td>{{$cmp->tin}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info add_custom_field" data-bs-toggle="modal"  data-table="company" data-bs-target="#custom_field" style="color:white">Add New Company</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="company" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            
        </div>
    </div>
    @endif

</div>
<script>
    $(document).ready(function() {
      $('#company-table').DataTable();
  } );
   </script>
@endsection