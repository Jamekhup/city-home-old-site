@extends('master')
@section('title')
    <title>Contact us - City Home Property Co.,ltd</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('style/contact.css')}}">
@endsection

@section('main-content')
    <div class="contactPage">
        @if (session()->has('success'))
        <div class="conRes">
            <p>{{session()->get('success')}}</p>
            <span class="conClose">&times;</span>
        </div>
        @endif
        <h1>Contact Us</h1>
        <p>If you would like to make inquiry about real estate in Myanmar,call <b>09409789556</b> or fill the below form and send us. </p>
        <small>* All fields are required.</small>
        <form action="{{route('contactMail')}}" id="contactForm" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="Enter Your Name">
            @if ($errors->has('name'))
                <small class="conErr">{{$errors->first('name')}}</small>
            @endif
            <input type="text" name="phone" id="phone" placeholder="Your Mobile Number">
            @if ($errors->has('phone'))
            <small class="conErr">{{$errors->first('phone')}}</small>
            @endif
            <input type="text" name="subject" id="subject" placeholder="Subject">
            @if ($errors->has('subject'))
            <small class="conErr">{{$errors->first('subject')}}</small>
            @endif
            <textarea id="sms" name="sms" cols="30" rows="10" placeholder="Your Message"></textarea>
            @if ($errors->has('sms'))
            <small class="conErr">{{$errors->first('sms')}}</small><br>
            @endif
            <button type="submit">Send</button>
        </form>
        
    </div>
@endsection
@section('script')
<script src="{{asset('script/contact.js')}}" defer></script> 
@endsection