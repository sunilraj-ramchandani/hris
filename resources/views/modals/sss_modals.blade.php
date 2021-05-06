<!-- Modal -->
<div class="modal fade " id="sss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SSS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('sss.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Salary Range (From)</label>
                            <input required type="number" name="price_min" id="price_min" class="mt-2 form-control">
                            <input type="hidden" name="id" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Salary Range (To)</label>
                            <input required type="number" name="price_max" id="price_max" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employee Contribution</label>
                            <input required type="number" name="ee_contribution" id="ee_contribution" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employer Contribution</label>
                            <input required type="number" name="er_contribution" id="er_contribution" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employee Compensation</label>
                            <input required type="number" name="ee_compensation" id="ee_compensation" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employer Compensation</label>
                            <input required type="number" name="er_compesation" id="er_compesation" class="mt-2 form-control">
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