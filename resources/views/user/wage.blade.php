@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.wage_modals')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="wage-table">
        <thead>
            <tr>
                <th>Region</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wage as $wages)
            <tr>
                <td>{{$wages->region}}</td>
                <td>{{$wages->price}}</td>
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#wage" class="wage_edit" data-region="{{$wages->region}}" data-price="{{$wages->price}}"  data-id="{{$wages->id}}"><i class="fa fa-edit"></i></button> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
  $(document).ready(function() {
    var table = $('#wage-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
</script>
@endsection