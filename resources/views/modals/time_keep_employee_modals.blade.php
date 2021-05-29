<!-- Modal -->
<div class="modal fade " id="view_time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Time Keeping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('time-keeping.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row"> 
                    <div class="col-6 form-group mt-4">
                        <label>Cutoff (From)</label>
                        <input required readonly type="date" name="from_date" id="from_date" class="mt-2 form-control">
                        <input type="hidden" name="id" class="mt-2 form-control">
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Cutoff (To)</label>
                        <input required readonly type="date" name="to_date" id="to_date" class="mt-2 form-control">
                    </div> 
                    <div class="col-12 form-group mt-4">
                        <label class="mb-2">Choose Employee</label>
                        <select name="emp_id[]" onchange="getMessage()" id="emp_id2" class="mt-2 form-control">
                            <option disabled selected>Select Employee</option>
                            @foreach($employees as $emp)
                            <option value="{{$emp->id}}">{{$emp->lastname}}, {{$emp->firstname}} {{$emp->middlename}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class = "row hidden">
                </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function getMessage() {
    var emp_id = $('#emp_id2').val();
    var date_from = $('#from_date').val();
    var date_to = $('#to_date').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url:'/time-keeping-ajax',
        data:{id:emp_id,from:date_from,to:date_to},
        success:function(response) {
            $(".hidden").empty()
            $(".hidden").append(response)
            console.log(response);
        },error: function(response){
            console.log(response);
        }
    });
}
</script>