<!-- Modal -->
<div class="modal fade " id="pagibig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pag-IBIG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('pagibig.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Salary Range (From)</label>
                            <input type="number" name="from" id="from" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Salary Range (To)</label>
                            <input type="number" name="to" id="to" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employee Rate (%)</label>
                            <input type="number" name="ee_rate" id="ee_rate" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Employer Rate (%)</label>
                            <input type="number" name="er_rate" id="er_rate" class="mt-2 form-control">
                            <input type="hidden" name="id" id="id" class="mt-2 form-control">
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