@extends('master')
@section('css')
<link rel="stylesheet" href="{{asset('style/pass.css')}}">
@endsection


@section('main-content')
    <div class="regSuccess">
        <div>
            @if (session('status') == 'verification-link-sent')
                <small class="success">New Verification Link has been sent to your email</small>
            @endif
            <p>Thanks for your registration. Your account has been registered successfully. Please check your email and confirm your account to continue.</p>
            <hr>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
            
               <button>Resend Verification Link</button>
            </form>
        </div>
    </div>
@endsection