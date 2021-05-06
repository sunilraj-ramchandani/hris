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
                            <input required type="number" name="price_min" id="price_min" class="mt-2 form-control" onkeyup="verify()">
                            <input type="hidden" name="id" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Salary Range (To)</label>
                            <input required type="number" name="price_max" id="price_max" class="mt-2 form-control">
                           <p id="errr" style="display: none;">Price max must higher on price min!!!</p>
                        </div>
                        <div class="form-group mt-4">
                            <label>Employee Contribution</label>
                            <input required type="number" name="ee_contribution" id="ee_contribution"  onkeyup="verify2()" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employer Contribution</label>
                            <input required type="number" name="er_contribution" id="er_contribution" onkeyup="verify2()" class="mt-2 form-control">
                            <p id="errrr" style="display: none;">Must higher than first employee contribution!</p>
                        </div>
                        <div class="form-group mt-4">
                            <label>Employee Compensation</label>
                            <input required type="number" name="ee_compensation" id="ee_compensation"  onkeyup="verify3()" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employer Compensation</label>
                            <input required type="number" name="er_compensation" id="er_compensation"  onkeyup="verify3()" class="mt-2 form-control">
                             <p id="errrrr" style="display: none;">Must higher than first employee compensation!</p>
                        </div>
                    </div>
                    <div class="form-group text-right mt-4">
                        <button class="submit-company btn btn-primary" id="submitszxc">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

