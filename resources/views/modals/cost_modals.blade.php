<!-- Modal -->
<div class="modal fade " id="cost_centers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cost Centers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('cost.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Name</label>
                            <input required type="text" name="name" id="name" class="mt-2 form-control">
                              <input type="text" name="id" class="mt-2 form-control" hidden="">
                        </div>
                    </div>
                    <div class = "col-12 formsz">
                        <div class="form-group mt-4">
                            <label>Description</label>
                            <textarea required name="desc" id="desc" class="mt-2 form-control"></textarea>
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