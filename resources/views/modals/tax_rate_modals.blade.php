<!-- Modal -->
<div class="modal fade " id="tax-rate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tax Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('tax-rate.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="alert alert-warning modal-alert fade show d-none" id = "error" role="alert">
                            <p>'From' cannot be larger than 'To'</p>
                        </div>
                        <div class="form-group mt-4">
                            <label>Tax Classification Name</label>
                            <select name="tax_classifications_id" id="tax_classifications_id" class="mt-2 form-control">
                                <option disabled selected>Select a classification</option>
                                @foreach($tax_classifications as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Salary Range (From)</label>
                            <input type="number" name="price_min" onkeyup="MinMaxValidate()" id="price_min" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Salary Range (To)</label>
                            <input type="number" name="price_max" onkeyup="MinMaxValidate()" id="price_max" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Rate (%)</label>
                            <input type="number" name="rate" id="rate" class="mt-2 form-control">
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