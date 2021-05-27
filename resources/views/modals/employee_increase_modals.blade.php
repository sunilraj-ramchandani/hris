<!-- Modal -->
<div class="modal fade " id="employees" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width:95vw;height:95vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Employee Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('employee-increase.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Employee Number</label>
                            <input type="text" name="employee_number" id="employee_number" class="mt-2 form-control">
                            <input type="hidden" name="id" id="id" class="mt-2 form-control">
                        </div>
                        
                        <div class = "row">
                            <div class="col-4 form-group mt-4">
                                <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="mt-2 form-control">
                            </div>
                            <div class="col-4 form-group mt-4">
                                <label>First Name</label>
                                <input type="text" name="firstname" id="firstname" class="mt-2 form-control">
                            </div>
                            <div class="col-4 form-group mt-4">
                                <label>Middle Name</label>
                                <input type="text" name="middlename" id="middlename" class="mt-2 form-control">
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Department</label>
                                <select name="department_id" id="department_id" class="mt-2 required form-control">
                                    <option disabled>Choose a Department</option> 
                                    @foreach($department as $dept)
                                    <option value="{{$dept->id}}">{{$dept->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Branch</label>
                                <select name="branch_id" id="branch_id" class="mt-2 required form-control">
                                    <option disabled>Choose a Branch</option> 
                                    @foreach($branch as $brc)
                                    <option value="{{$brc->id}}">{{$brc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Cost Center</label>
                                <select name="cost_centers_id" id="cost_centers_id" class="mt-2 required form-control">
                                    <option disabled>Choose a Cost Center</option> 
                                    @foreach($cost_centers as $cost)
                                    <option value="{{$cost->id}}">{{$cost->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Position</label>
                                <select name="position_id" id="position_id" class="mt-2 required form-control">
                                    <option disabled>Choose a Position</option> 
                                    @foreach($employee_position as $pos)
                                    <option value="{{$pos->id}}">{{$pos->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Employee Status</label>
                                <select name="status_id" id="status_id" class="mt-2 required form-control">
                                    @foreach($employee_status as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Basic Pay</label>
                                <input type="number" step="0.01"  readonly name="basic_pay" id="basic_pay" class="mt-2 form-control">
                            </div>
                            <div class="col-4 form-group mt-4">
                                <label>Vacation Leave</label>
                                <input type="number" step="0.01" readonly name="vacation_leave" id="vacation_leave" class="mt-2 form-control">
                            </div>
                            <div class="col-4 form-group mt-4">
                                <label>Sick Leave</label>
                                <input type="number" step="0.01" readonly name="sick_leave" id="sick_leave" class="mt-2 form-control">
                            </div>
                            <div class="col-4 form-group mt-4">
                                <label>Hiring Date</label>
                                <input type="date" readonly name="hiring_date" id="hiring_date" class="mt-2 form-control">
                            </div>
                        </div>
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