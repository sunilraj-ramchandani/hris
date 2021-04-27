<!-- Modal -->
<div class="modal fade " id="company" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
            <div class="modal-body">
            <form action="{{route('company.add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class = "row">
                    <div class = "col-12">
                        <div class="form-group mt-4">
                            <label>Company Name</label>
                            <input required type="text" name="name" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Company Address</label>
                            <input required type="text" name="address" class="mt-2 form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label>Company TIN</label>
                            <input required type="number" name="tin" class="mt-2 form-control">
                        </div>
                    </div>
                    <div class="form-group text-right mt-4">
                        <button class="btn btn-primary">Add New Company</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>