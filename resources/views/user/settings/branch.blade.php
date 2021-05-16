@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.branch_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="branch-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>address</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branch as $brc)
            <tr>
                <td>{{$brc->name}}</td>
                <td>{{$brc->address}}</td>

                @foreach($fields_value as $val)
                    @if($val->company_id == $brc->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>  <button class="edit_button btn btn-info" data-bs-toggle="modal" data-bs-target="#branch" data-name="{{$brc->name}}" data-address="{{$brc->address}}" data-id="{{$brc->id}}"><i class="fa fa-edit"></i></button> 
                    <button class="delete_button btn btn-danger" data-bs-toggle="modal" data-table="branch-add" data-bs-target="#delete_pop"  data-id="{{$brc->id}}"><i class="fas fa-trash-alt"></i></button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#branch" style="color:white">Add New Branch</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="branch" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#branch-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );

 $(".branch_edit").click(function(){
     $('.modal-title').text('Edit Branch Information');
     
        $('.submit-company').text('Update Company');
        $("[name='name']").val($(this).data("name"));
        $("[name='address']").val($(this).data("address"));
        $("[name='id']").val($(this).data("id"));
    });

  $(".branch_delete").click(function(){
        $('.modal-title').text('Are you sure you want to delete company?');
        $('.submit-company').text('Yes');
        $("[name='id']").val($(this).data("id"));
        $(".formsz").hide();
        $('#names').prop('required',false);
        $('#addresss').prop('required',false);
        $(".modal-dialog").removeClass('modal-xl');
    });
     $(".btn-close").click(function(){
        $("[name='name']").val('');
        $("[name='address']").val('');
  
        $("[name='id']").val('');
    });
    $('#branch').on('hidden.bs.modal', function () {
        $("[name='name']").val('');
        $("[name='address']").val('');
        $("[name='id']").val('');
        $(".formsz").show();
        $('#name').prop('required',true);
        $('#address').prop('required',true);
        $(".modal-dialog").addClass('modal-xl');
    })
</script>
@endsection