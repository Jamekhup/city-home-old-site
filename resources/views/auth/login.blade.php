@extends('master')
@section('css')
<link rel="stylesheet" href="{{asset('style/login.css')}}">
@endsection

@section('main-content')
    <div class="loginPage">
        <h1>Login</h1>
        <form action="{{route('login')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email Address">
            @if ($errors->has('email'))
            <small class="error">{{$errors->first('email')}}</small>
            @endif
            <input type="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
            <small class="error">{{$errors->first('password')}}</small>
            @endif
            <input type="checkbox" name="remember"> <small>Remember Me</small> <br>
            <button>Login</button>
            <hr>
            <div class="row">
                <p>Forgot Password? <a href="{{route('password.request')}}">Click Here</a></p>
                <p>Not Register Yet? <a href="{{route('register')}}">Register Here</a></p>
            </div>
        </form>
    </div>
@endsection