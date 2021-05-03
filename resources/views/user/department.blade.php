@extends('master')
@section('title', 'System Setup')

@section('content')
@include('modals.department_modals')
@include('includes.custom_field_view')
<div class="container-fluid pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <div id="button_wrapper" class="small-6 columns pt-4 mt-4 mb-4"></div>
    <table class="table table-bordered" id="department-table">
        <thead>
            <tr>
                <th>Name</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($department as $dpt)
            <tr>
                <td>{{$dpt->name}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $dpt->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#department" class="company_edit" data-name="{{$dpt->name}}" data-id="{{$dpt->id}}"><i class="fa fa-edit"></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#department"  data-id="{{$dpt->id}}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <hr>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#department" style="color:white">Add New Department</button>
            <button type="button" class = "btn btn-warning add_custom_field" data-bs-toggle="modal"  data-table="department" data-bs-target="#custom_field">Add Custom Field</button>
        </div>
    </div>

    @endif
</div>

<script>
  $(document).ready(function() {
    var table = $('#department-table').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( $('#button_wrapper') );
} );
        $(".company_edit").click(function(){
     
        $("[name='address']").val($(this).data("name"));
        $("[name='id']").val($(this).data("id"));
    });
  $(".btn-close").click(function(){

        $("[name='address']").val('');
   
        $("[name='id']").val('');
    });
    $('#department').on('hidden.bs.modal', function () {
      
        $("[name='address']").val('');
     
        $("[name='id']").val('');
        $(".formsz").show();
  
        $('#address').prop('required',true);

        $(".modal-dialog").addClass('modal-xl');
    })
    
  $(".company_delete").click(function(){
        $('.modal-title').text('Are you sure you want to delete company?');
        $('.submit-company').text('Yes');
        $("[name='id']").val($(this).data("id"));
        $(".formsz").hide();
        $('#name').prop('required',false);
        $('#address').prop('required',false);
        $('#tin').prop('required',false);
        $(".modal-dialog").removeClass('modal-xl');
    });
</script>

@endsection