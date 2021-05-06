<!-- Modal -->
<div class="modal fade " id="allowance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Allowances</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('allowance.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="mt-2 form-control">
                            <input type="hidden" name="id" id="id" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Description</label>
                            <textarea name="desc" id="desc" class="mt-2 form-control"> </textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label>Interest</label>
                            <input type="number" name="interest" id="interest" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="taxable" id="taxable">
                                <label class="form-check-label" for="taxable">
                                    Taxable
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="non-taxable" id="non-taxable" checked>
                                <label class="form-check-label" for="non-taxable">
                                    Non-Taxable
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="deminimis" id="deminimis" checked>
                                <label class="form-check-label" for="deminimis">
                                    De Minimis
                                </label>
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