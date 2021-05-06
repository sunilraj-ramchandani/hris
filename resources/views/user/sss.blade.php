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
                <td>{{$SSS->er_contribution}}</td>
                <td>{{$SSS->ee_compensation}}</td>
                <td>{{$SSS->er_compesation}}</td>
                @foreach($fields_value as $val)
                    @if($val->company_id == $SSS->id)
                        <td>{{$val->custom_value}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                @endforeach
                <td>
                    <button class="company_edit btn btn-info" data-bs-toggle="modal" data-bs-target="#sss" class="company_edit" data-id="{{$SSS->id}}"data-min="{{$SSS->price_min}}" data-max="{{$SSS->price_max}}" data-ee_contribution="{{$SSS->ee_contribution}}" data-ee_contributions="{{$SSS->er_contribution}}" data-ee_compensation="{{$SSS->ee_compensation}}" data-ee_compensations="{{$SSS->er_compesation}}"><i class="fa fa-edit"></i></button> 
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
<script>
$(document).ready(function() {
  $("#price_max").on("input", function() {
    verify()
  });
});
$(".btn-close").click(function(){

        $("[name='price_min']").val('');
   
        $("[name='price_max']").val('');
        $("[name='ee_contribution']").val('');
   
        $("[name='er_contribution']").val('');

        $("[name='ee_compensation']").val('');
   
        $("[name='er_compensation']").val('');

    });
    $('#sss').on('hidden.bs.modal', function () {
        $("[name='price_min']").val('');
   
        $("[name='price_max']").val('');
        $("[name='ee_contribution']").val('');
   
        $("[name='er_contribution']").val('');

        $("[name='ee_compensation']").val('');
   
        $("[name='er_compensation']").val('');
        $(".formsz").show();
  
        $('#price_max').prop('required',true);
        $('#price_min').prop('required',true);
          $('#ee_contribution').prop('required',true);
        $('#er_contribution').prop('required',true);
          $('#ee_compensation').prop('required',true);
        $('#er_compensation').prop('required',true);


        $(".modal-dialog").addClass('modal-xl');
    })
     $(".company_edit").click(function(){
     
        $("[name='price_min']").val($(this).data("min"));

        $("[name='price_max']").val($(this).data("max"));
        $("[name='ee_contribution']").val($(this).data("ee_contribution"));

        $("[name='er_contribution']").val($(this).data("ee_contributions"));
        $("[name='ee_compensation']").val($(this).data("ee_compensation"));

        $("[name='er_compensation']").val($(this).data("ee_compensations"));
        $("[name='id']").val($(this).data("id"));
    });

  $(".company_delete").click(function(){
        $('.modal-title').text('Are you sure you want to delete company?');
        $('.submit-company').text('Yes');
        $("[name='id']").val($(this).data("id"));
        $(".formsz").hide();
        $('#ee_contribution').prop('required',false);
        $('#price_max').prop('required',false);
        $('#price_min').prop('required',false);
         $('#er_contribution').prop('required',false);
        $('#ee_compensation').prop('required',false);
        $('#er_compensation').prop('required',false);
        $(".modal-dialog").removeClass('modal-xl');
    });
function verify() {
  var firstValue = parseInt($("#price_min").val());
  var secondValue = parseInt($("#price_max").val());
  if (firstValue <= secondValue) {
$("#errr").hide();

 $("#submitszxc").attr("disabled", false);
  } else {
 $("#submitszxc").attr("disabled", true);
 $("#errr").show();
   }
}  
</script>
<script>


function verify2() {
  var firstValues = parseInt($("#ee_contribution").val());
  var secondValues= parseInt($("#er_contribution").val());
  if (firstValues <= secondValues) {
$("#errrr").hide();

 $("#submitszxc").attr("disabled", false);
  } else {
 $("#submitszxc").attr("disabled", true);
 $("#errrr").show();
   }
}  
function verify3() {
  var firstValuess = parseInt($("#ee_compensation").val());
  var secondValuess= parseInt($("#er_compensation").val());
  if (firstValuess <= secondValuess) {
$("#errrrr").hide();

 $("#submitszxc").attr("disabled", false);
  } else {
 $("#submitszxc").attr("disabled", true);
 $("#errrrr").show();
   }
}  
</script>
@endsection