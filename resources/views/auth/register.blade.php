@extends('master')
@section('css')
<link rel="stylesheet" href="{{asset('style/register.css')}}">
@endsection

@section('main-content')
    <div class="regPage">
        <h1>Register</h1>
        <form action="{{route('register')}}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Enter Your Name">
            @if ($errors->has('name'))
                <small class="error">{{$errors->first('name')}}</small>
            @endif
            <input type="email" name="email" placeholder="Enter Your Email">
            @if ($errors->has('email'))
            <small class="error">{{$errors->first('email')}}</small>
            @endif
            <input type="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
            <small class="error">{{$errors->first('password')}}</small>
            @endif
            <input type="password" name="password_confirmation" placeholder="Confirm Password">
            @if ($errors->has('password_confirmation'))
            <small class="error">{{$errors->first('password_confirmation')}}</small>
            @endif
            <button>Register</button>
            <hr>
            <div class="row">
                <p>Already Registered? <a href="{{route('login')}}">Login Here</a></p>
            </div>
        </form>
    </div>
@endsection