<!-- Modal -->
<div class="modal fade " id="employees_loan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Employee Loans</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('employee-emp-loan.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Employee Number</label><br>
                            <select name="emp_id" id="emp_id" required class="mt-2 form-control">
                                <option readonly>Choose Employee</option>
                                @foreach($employee as $emp)
                                <option value = "{{$emp->id}}">{{$emp->employee_number}} ({{$emp->lastname}}, {{$emp->firstname}} {{$emp->middlename}})</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" id="id" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Loan Type</label>
                            <select name="loan" id="loan" class="mt-2 form-control">
                                @foreach($loans as $all)
                                <option value = "{{$all->id}}">{{$all->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class = "row">
                            <div class="col-6 form-group mt-4">
                                <label>Amount</label>
                                <input type="number" step="0.01" name="amount" id="amount" class="mt-2 form-control">
                            </div>
                            <div class="col-6 form-group mt-4">
                                <label>Months to Pay</label>
                                <input type="number" name="months" id="months" class="mt-2 form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            @foreach ($pay_settings as $settings)
                                <div class="col offset-1 form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="first_payout" id="first_payout">
                                    <label class="form-check-label" for="first_payout">
                                        First Payout
                                    </label>
                                </div>
                                @if($settings->payout_number > 1)
                                <div class="col form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="second_payout" id="second_payout">
                                    <label class="form-check-label" for="second_payout">
                                        Second Payout
                                    </label>
                                </div>
                                @endif
                                @if($settings->payout_number > 2)
                                <div class="col form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="third_payout" id="third_payout">
                                    <label class="form-check-label" for="third_payout">
                                        Third Payout
                                    </label>
                                </div>
                                @endif
                                @if($settings->payout_number > 3)
                                <div class="col form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="fourth_payout" id="fourth_payout">
                                    <label class="form-check-label" for="fourth_payout">
                                        Fourth Payout
                                    </label>
                                </div>
                                @endif
                            @endforeach
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