@extends('master')
@section('css')
<link rel="stylesheet" href="{{asset('style/pass.css')}}">
@endsection

@section('main-content')
    <div class="resetPass">
        <div>
           
            <h1>Reset New Password</h1>
            <form action="{{route('password.update')}}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="email" name="email" value="{{old('email',$request->email)}}">
                @if ($errors->has('email'))
                    <small class="error">{{$errors->first('email')}}</small>
                @endif
                <input type="password" name="password" placeholder="New Password">
                @if ($errors->has('password'))
                <small class="error">{{$errors->first('password')}}</small>
                @endif
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                <button>Update Password</button>
            </form>
        </div>
    </div>
@endsection