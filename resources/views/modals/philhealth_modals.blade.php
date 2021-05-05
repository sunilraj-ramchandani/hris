<!-- Modal -->
<div class="modal fade " id="phealth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Philhealth</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('philhealth.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Salary From</label>
                            <input required type="number" name="price_min" id="price_min" class="mt-2 form-control">
                            <input type="hidden" name="id" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Salary To</label>
                            <input required type="number" name="price_max" id="price_max" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Fixed or Percent</label>
                            <select name="method" id="method" class = "form-control mt-2">
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label>Rate</label>
                            <input required type="number" name="rate" id="rate" class="mt-2 form-control">
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