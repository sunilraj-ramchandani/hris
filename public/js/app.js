$(document).ready(function() {
    $(".edit_button").click(function(){
        $.each( $(this).data(),function(i, e) {
            if(i != 'bs-target' || i != 'bs-toggle'|| i != 'table'){
                $("[name='"+i+"']").val(e);
            }
        });
    });
    $(".delete_button").click(function(){
        $('#delete_pop #delete_modal').attr('action', $(this).data("table"));
        $("#delete_pop [name='id'").val($(this).data("id"));
    });
    $(".btn-close").click(function(){
        $("input").each(function(){
            $(this).val('');
        });
    });
    $('.modal').on('hidden.bs.modal', function (e) {
        $("input").each(function(){
            $(this).val('');
        });
        $(".modal-alert").each(function(){
            $(this).addClass('d-none');
        });
    })
});
function MinMaxValidate(){
    if($('#price_min').val() && $('#price_max').val()){
      if(parseFloat($('#price_min').val()) > parseFloat($('#price_max').val())){
        $('#error').removeClass('d-none');
        $('#error').addClass('d-block');
      }else{
        $('#error').removeClass('d-block');
        $('#error').addClass('d-none');
      }
    }
}
