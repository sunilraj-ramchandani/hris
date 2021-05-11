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
                <th>Fixed or Percent</th>
                <th>Premium Rate</th>
                @foreach($fields_value as $val)
                <th>{{$val->field_name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($philhealth as $phealth)
            <tr>
                <td>{{$phealth->price_min}}</td>
                <td>{{$phealth->price_max}}</td>
                <td>{{$phealth->method}}</td>
                <td>{{$phealth->rate}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $phealth->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#phealth" class="company_edit" data-id="{{$phealth->id}}" data-price_min="{{$phealth->price_min}}" data-price_max="{{$phealth->price_max}}" data-method="{{$phealth->method}}" data-rate="{{$phealth->rate}}"><i class="fa fa-edit" ></i></button> 
                    <button class="company_delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#phealth"  data-id="{{$phealth->id}}"><i class="fas fa-trash-alt"></i></button>
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

     $(".company_edit").click(function(){
     
        $("[name='price_min']").val($(this).data("price_min"));

        $("[name='price_max']").val($(this).data("price_max"));
        $("[name='method']").val($(this).data("method"));

        $("[name='rate']").val($(this).data("rate"));
        $("[name='id']").val($(this).data("id"));
    });

    $('#phealth').on('hidden.bs.modal', function () {
        $("[name='price_min']").val('');
   
        $("[name='price_max']").val('');
        $("[name='method']").val('');
   
        $("[name='rate']").val('');
        $(".formsz").show();
  
        $('#price_max').prop('required',true);
        $('#price_min').prop('required',true);
          $('#method').prop('required',true);
        $('#rate').prop('required',true);

        $(".modal-dialog").addClass('modal-xl');
    })


  $(".company_delete").click(function(){
        $('.modal-title').text('Are you sure you want to delete company?');
        $('.submit-company').text('Yes');
        $("[name='id']").val($(this).data("id"));
        $(".formsz").hide();
        $('#ee_contribution').prop('required',false);
        $('#price_max').prop('required',false);
        $('#price_min').prop('required',false);
         $('#method').prop('required',false);
        $('#rate').prop('required',false);
    });
</script>
@endsection