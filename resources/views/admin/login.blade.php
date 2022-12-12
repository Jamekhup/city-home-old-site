@extends('master')
@section('css')
<link rel="stylesheet" href="{{asset('style/adminlogin.css')}}">    
@endsection
@section('main-content')
    <div class="adminLogin">
        <h1>Admin Login</h1>
        @if (session()->has('loginFail'))
            <small class="logError">{{session()->get('loginFail')}}</small>
        @endif
        <form action="{{route('admin.login')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email Address">
            @if ($errors->has('email'))
                <small class="logError">{{$errors->first('email')}}</small>
            @endif
            <input type="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
            <small class="logError">{{$errors->first('password')}}</small> <br>
            @endif
            <input type="checkbox" name="remember"> <small>Remember Me</small><br>
            <button>Login</button>
        </form>
    </div>
@endsection