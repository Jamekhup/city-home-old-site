@section('css')
@section('title')
<title>Real Estate, Properties For Sale and For Rent in Yangon, Myanmar</title>
@endsection
@section('description')
<meta name="description" content="Looking for properties to buy or rent? We offer the best real estate services such as apartment, condo, warehouse, land, shop, store and private house both for sale and rent. Contact us now and get what you are looking for. ">
@endsection
<link rel="stylesheet" href="{{asset('style/home.css')}}">
@endsection
@extends('master')

@section('main-content')

<div class="scrollNav">
    <form action="{{route('homeSearch')}}" method="GET">
        {{-- @csrf --}}
        <input name="search" type="text" id="navSearch" placeholder="Enter Township">
        <div class="sIcon">
            <i class="fas fa-search"></i>
        </div>
        <button style="display: none;">submit</button>
    </form>
</div>

    <div class="bg">
    
        <div class="bgSearch">
            <h2>Get What You Are Looking For</h2>
            <form action="{{route('homeSearch')}}" method="GET">
                {{-- @csrf --}}
                <input name="search" type="text" id="bgSearch" placeholder="Enter Township">
                <div class="sIcon">
                    <i class="fas fa-search"></i>
                </div>
                <button style="display: none;">submit</button>
            </form>
        </div>
    </div>
    <div class="homeMain">
        <h1>Let us guide to your new home</h1>
        <div class="row">
            <div class="col">
                <img src="{{asset('img/buy-home.png')}}" alt="">
                <div>
                    <h3>Properties For Sale</h3>
                    <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
                        document or a typeface without relying on meaningful conten</p>
                    <a href="for-sale/">View More</a>
                </div>
            </div>
            <div class="col">
                <img src="{{asset('img/rent-home.png')}}" alt="">
                <div>
                    <h3>Properties For Rent</h3>
                    <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
                        document or a typeface without relying on meaningful conten</p>
                    <a href="for-rent/">View More</a>
                </div>
            </div>
            <div class="col">
                <img src="{{asset('img/sale.png')}}" alt="">
                <div>
                    <h3>Sell by yourself</h3>
                    <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
                        document or a typeface without relying on meaningful conten</p>
                    <a href="{{route('login')}}">Find Out</a>
                </div>
            </div>
        </div>

        
       <div id="sub">
           <h2>Subscribe to get updated information</h2>

           <form action="{{route('sub')}}" method="POST" id="subForm">
            <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                <div class="subErr"></div>
               <input autocomplete="email" type="text" id="email" class="subscribe" placeholder="Enter Your Email">
               <button id="subBtn" type="submit">Subscribe</button>
           </form>
       </div>

    </div>
    @if (session()->has('success-sub'))
        <div class="sub-success">
            <p>{{session()->get('success-sub')}}</p>
            <span class="closeSubSuccess" onclick="closeSubSuccess()">&times;</span>
        </div>
    @endif
    
@endsection
@section('script')
<script src="{{asset('script/jquery.js')}}" defer></script>
<script src="{{asset('script/home.js')}}" defer></script>
@endsection