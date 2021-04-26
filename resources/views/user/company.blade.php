@extends('master')
@section('title', 'System Setup')

@section('content')
<div class="container pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    @foreach($company as $cmp)
    <div class = "row">
        <div class = "col-4">
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input required value = "{{$cmp->name}}" type="text" id="company_name" name="company_name" class="mt-2 form-control">
            </div>
        </div>
        <div class = "col-4">
            <div class="form-group">
                <label for="company_address">Company Address</label>
                <input required value = "{{$cmp->address}}" type="text" id="company_address" name="company_address" class="mt-2 form-control">
            </div>
        </div>
        <div class = "col-2">
            <div class="form-group">
                <label for="company_tin">Company TIN</label>
                <input type="text" value = "{{$cmp->tin}}" id="company_tin" name="company_tin" class="mt-2 form-control">
            </div>
        </div>
    </div>
    <div class = "row pt-4">
        <hr>
        @for ($i = 0; $i < count($fields[0]); $i++)
            @if($fields[0][$i][0] == $cmp->id)
                <div class = "col-3 mt-4">
                    <div class="form-group">
                        {!!$fields[0][$i][1]!!}
                        {!!$fields[0][$i][2]!!}
                    </div>
                </div>
            @endif
        @endfor
    </div>
    @if($edit_roles == "edit")
    <div class = "row pt-4 mt-4">
        <div class = "col-12 text-right">
            <button type="button" class = "btn btn-info add_custom_field" data-bs-toggle="modal"  data-table="company" data-bs-target="#custom_field" style="color:white">Add Custom Field</button>
        </div>
    </div>
    @endif
    @endforeach
</div>

@endsection