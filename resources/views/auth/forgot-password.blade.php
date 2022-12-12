@extends('master')
@section('css')
<link rel="stylesheet" href="{{asset('style/pass.css')}}"> 
@endsection

@section('main-content')
    <div class="requestLink">
        <div class="">
            @if (session()->has('status'))
                <small class="success">Link to reset password has been sent to you email.</small>
            @endif
            <h1>Request Password Reset Link</h1>
            <form action="{{route('password.email')}}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Enter Your Email">
                @if ($errors->has('email'))
                <small class="error">{{$errors->first('email')}}</small>
                @endif
                <button>Request</button>
            </form>
        </div>
    </div>
@endsection