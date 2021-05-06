@extends('master')
@section('title', 'System Setup')

@section('content')
<div class="container pt-4 mt-4">
    @if (Session::has('success_msg'))
        <div class="alert alert-success fade show" role="alert">
            {{session('success_msg')}}
        </div>
    @endif
    <form action="{{route('settings.post')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class = "row">
            <h3>Modules</h3>
            <hr>
            @foreach($setups as $setup)
            <div class = "col-2 mt-2">
                <label>{{$setup->module_name}}</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="{{$setup->module_id}}" class="onoffswitch-checkbox" id={{$setup->module_id}} tabindex="0" @if($setup->status == 1)checked @endif>
                    <label class="onoffswitch-label" for={{$setup->module_id}}>
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <div class = "row pt-4 mt-4">
            <h3>Attendance and Pay Process</h3>
            <hr>
            <div class = "col-2 mt-2">
                <label>24 hours Shift</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="shift" tabindex="0">
                    <label class="onoffswitch-label" for="shift">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class = "col-2 mt-2">
                <label>Attendance Approver</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="attendance-approver" tabindex="0" checked>
                    <label class="onoffswitch-label" for="attendance-approver">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class = "col-2 mt-2">
                <label>Pay Approver</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="pay-approver" tabindex="0" checked>
                    <label class="onoffswitch-label" for="pay-approver">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class = "col-3 mt-2">
                <label>Permanent Lock Attendance</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="attendance-lock" tabindex="0">
                    <label class="onoffswitch-label" for="attendance-lock">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class = "col-2 mt-2">
                <label>Permanent Lock Pay</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="pay-lock" tabindex="0">
                    <label class="onoffswitch-label" for="pay-lock">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div> 
            <div class = "col-2 mt-2">
                <label>Philhealth Deduction (Charge on Basic Pay)</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="phil-deduct" tabindex="0">
                    <label class="onoffswitch-label" for="phil-deduct">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class = "col-2 mt-2">
                <label>SSS Deduction (Charge on Basic Pay)</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="sss-deduct" tabindex="0">
                    <label class="onoffswitch-label" for="sss-deduct">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div> 
            <div class = "col-2 mt-2">
                <label>Tax Deduction (Charge on Basic Pay)</label>
                <div class="onoffswitch mt-2">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="tax-deduct" tabindex="0">
                    <label class="onoffswitch-label" for="tax-deduct">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div> 
        </div>
        @if($edit_roles == "edit")
        <div class = "d-none text-center col-11 mt-4" id = "submit">
            <hr>
            <button style="border-radius:10px;width:50%;color:white" class = "btn btn-info"> Update </button>
        </div>
        @endif
    </form>
</div>
<script>
$('input[type="checkbox"]').click(function(){
    $('#submit').removeClass("d-none");
    $('#submit').css("display","block");
});
</script>

@endsection