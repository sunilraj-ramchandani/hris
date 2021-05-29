<!-- Modal -->
<div class="modal fade " id="time-keep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input required type="date" name="from" id="from" class="mt-2 form-control">
                        <input type="hidden" name="id" class="mt-2 form-control">
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Cutoff (To)</label>
                        <input required type="date" name="to" id="to" class="mt-2 form-control">
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Branch</label>
                        <select name="branch" id="branch" class="mt-2 form-control">
                            <option value="0">All</option>
                            @foreach($branch as $brnch)
                            <option value="{{$brnch->id}}">{{$brnch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Cost Center</label>
                        <select name="cost" id="cost" class="mt-2 form-control">
                            <option value="0">All</option>
                            @foreach($cost as $cst)  
                            <option value="{{$cst->id}}">{{$cst->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label>Department</label>
                        <select name="department" id="department" class="mt-2 form-control">
                            <option value="0">All</option>
                            @foreach($department as $dpt)
                            <option value="{{$dpt->id}}">{{$dpt->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group mt-4">
                        <label class="mb-2">Exclude Employees</label>
                        <select name="emp_id[]" multiple="multiple" id="emp_id" class="mt-2 form-control">
                            <option value="0">All</option>
                            @foreach($employees as $emp)
                            <option value="{{$emp->id}}">{{$emp->lastname}}, {{$emp->firstname}} {{$emp->middlename}}</option>
                            @endforeach
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