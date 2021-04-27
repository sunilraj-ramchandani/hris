<!-- Modal -->
<div class="modal fade modal-dialog modal-lg" id="custom_field" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Custom Field</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form action="{{route('custom_field.post')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class = "row">
          <div class = "col-12">
            <div class="form-group mt-4">
              <label>Field Name</label>
              <input type="text" name="field_name" class="mt-2 form-control">
              <input value="" hidden id = "field_table" name="field_table" class="mt-2 form-control">
            </div>
            <div class="form-group mt-4">
              <label>Field Type</label>
              <select name = "field_type" class="mt-2 form-control">
                <option selected value="text">Text</option>
                <option value="email">Email</option>
                <option value="area">Area</option>
              </select>
            </div>
            <div class="form-group mt-4">
              <label>Field Length</label>
              <input type="number" min="1" max="255" name="field_length" class="mt-2 form-control">
            </div>
            <div class="form-group mt-4">
              <label>Field Default Value</label>
              <input type="text" min="1" max="255" name="field_value" class="mt-2 form-control">
            </div>
          </div>
          <div class="form-group mt-4">
            <button class="btn btn-primary">Add New Field</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>