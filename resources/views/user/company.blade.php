@extends('master')
@section('title', 'System Setup')

@section('content')
<div class="container pt-4 mt-4">
    <div class = "row">
        <div class = "col-2">
            <div class="form-group">
                <label for="company_code">Company Code</label>
                <input type="text" id="company_code" name="company_code" class="mt-2 form-control">
            </div>
        </div>
        <div class = "col-4">
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input required type="text" id="company_name" name="company_name" class="mt-2 form-control">
            </div>
        </div>
        <div class = "col-4">
            <div class="form-group">
                <label for="company_address">Company Address</label>
                <input required type="text" id="company_address" name="company_address" class="mt-2 form-control">
            </div>
        </div>
        <div class = "col-2">
            <div class="form-group">
                <label for="company_tin">Company TIN</label>
                <input type="text" id="company_tin" name="company_tin" class="mt-2 form-control">
            </div>
        </div>
    </div>
    @if($edit_roles == "edit")
    <div class = "row pt-4">
        <h4>Custom Fields</h4>
    </div>
    @endif
</div>
@endsection