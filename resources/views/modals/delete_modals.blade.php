<!-- Modal -->
<div class="modal" id="delete_pop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this row?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "delete_modal" action="" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class = "row">
                        <div class = "col-12 formsz">
                            <div class="form-group mt-4">
                                <input type="text" name="id" class="mt-2 form-control" hidden>
                            </div>
                        </div>
                        <div class="form-group text-right mt-4">
                            <button class="submit-company btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>