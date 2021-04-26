@extends('master')
@section('title', 'LOGIN')

@section('content')
<div class="main">
    <p class="sign" align="center">Sign in</p>
    @if (Session::has('error_msg'))
        <p class = "text-center" style= "color:red">{{session('error_msg')}}</p>
    @else
        <p class = "text-center" style= "color:transparent">no message</p>
    @endif
    <form action="{{route('login')}}" method="post" class="form1">
        {{csrf_field()}}
        <input type="text" name="username" id="username" class="un"  align="center" placeholder="Username">
        <input type="password" name="password" id="password" class="pass"  align="center" placeholder="Password">
        <button class="submit">Sign in</button>
        <p class="forgot" align="center"><a href="#">Forgot Password?</p>
    </form>                      
</div>
@stop