<!-- Modal -->
<div class="modal fade " id="time_entry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Time Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('time-entry.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    @foreach($employee_details as $details)
                    <div class="col-12 form-group mt-4">
                        <label>Employee ID</label>
                        <input readonly type="text" value="{{$details->employee_number}}" name="emp_no" id="emp_no" class="mt-2 form-control">
                        <input readonly type="hidden" value="{{$details->id}}" name="emp_id" id="emp_id" class="mt-2 form-control">
                    </div>
                    @endforeach
                    <div class="col-6 form-group mt-4">
                        <label>Time In</label>
                        <input required type="datetime-local" onchange="getHours()" name="timein" id="timein" class="mt-2 form-control">
                        <input type="hidden" name="id" class="mt-2 form-control">
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Time Out</label>
                        <input required type="datetime-local" onchange="getHours()" name="timeout" id="timeout" class="mt-2 form-control">
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Hours</label>
                        <input readonly type="text" name="hours" id="hours" class="mt-2 form-control">
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Entry Type</label>
                        <select name="entry_type" id="entry_type" class="mt-2 form-control">
                            <option value="Regular">Regular</option>
                            <option value="Leave without pay">Leave without pay</option>
                            <option value="Leave with pay">Leave with pay</option>
                        </select>
                    </div>
                    <div class="form-group text-right mt-4">
                        <button class="submit-company btn btn-primary">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function diff_hours(dt2, dt1) {
        var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60);
        return Math.abs(Math.round(diff));
    }  
    function getHours(){
        if($('#timein').val() != '' && $('#timeout').val() != ''){
            var datefrom = new Date($('#timein').val());
            var dateto = new Date($('#timeout').val());
            var diff = dateto.valueOf() - datefrom.valueOf();
            var diffInHours = diff/1000/60/60;
            $('#hours').val(diffInHours);
        }
    }
</script>