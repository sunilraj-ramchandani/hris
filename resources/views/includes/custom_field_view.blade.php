<!-- Modal -->
<div class="modal fade " id="custom_field_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Company Custom Fields</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class = "row"> 
                    <div class = "row pt-4">
                        <div class = "col-12">
                            <h4>Custom Fields</h4>
                            <hr>
                            @for ($i = 0; $i < count($fields[0]); $i++)
                            @if($fields[0][$i][0] == Session::get('company'))
                                <div class = "col-12 mt-4">
                                    <div class="form-group">
                                        {!!$fields[0][$i][1]!!}
                                        {!!$fields[0][$i][2]!!}
                                    </div>
                                </div>
                            @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>