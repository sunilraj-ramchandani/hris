<!-- Modal -->
<div class="modal fade " id="employees" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Employee Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('employee.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Employee Number</label>
                            <input type="text" name="emp_no" id="emp_no" class="mt-2 form-control">
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
                                <select name="dept" id="dept" class="mt-2 required form-control">
                                    <option disabled>Choose a Department</option> 
                                    @foreach($department as $dept)
                                    <option value="{{$dept->id}}">{{$dept->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Branch</label>
                                <select name="branch" id="branch" class="mt-2 required form-control">
                                    <option disabled>Choose a Branch</option> 
                                    @foreach($branch as $brc)
                                    <option value="{{$brc->id}}">{{$brc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Cost Center</label>
                                <select name="cost" id="cost" class="mt-2 required form-control">
                                    <option disabled>Choose a Cost Center</option> 
                                    @foreach($cost_centers as $cost)
                                    <option value="{{$cost->id}}">{{$cost->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Position</label>
                                <select name="position" id="position" class="mt-2 required form-control">
                                    <option disabled>Choose a Position</option> 
                                    @foreach($employee_position as $pos)
                                    <option value="{{$pos->id}}">{{$pos->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Employee Status</label>
                                <select name="status" id="status" class="mt-2 required form-control">
                                    <option disabled>Choose an Employee Status</option> 
                                    @foreach($employee_status as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
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