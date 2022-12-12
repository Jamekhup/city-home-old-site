@extends('master')
@section('title')
<title>Property Search Results</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('style/property.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('main-content')
@php
error_reporting(0);
@endphp
<div class="mainProperty">
    <div class="selectSearch">
        @include('inc.searchform')
    </div>

    <div class="proLists">
        <div class="row">
            <div class="sortLists">
                @include('inc.body-side')
            </div>
            <div class="all_lists">

                <h1>Your Search Results
                    <span>{{count($property)}} Listings</span></h1>
                <div class="row" id="loadMore">
                    @if (count($property) > 0)
                    @foreach ($property as $list)
                    <div class="col" id="listItems">
                    
                        <p style="display:none;" class="myid">{{$list->id}}</p>
                        <p style="display:none;" class="address">{{$list->address}}</p>
                        <p style="display:none;" class="mytype">{{str_replace(' ',' ',ucwords(str_replace('-',' ',$list->saleRent)))}}</p>
                        <p style="display:none;" class="mycat">{{str_replace(' ',' ',ucwords(str_replace('-',' ',$list->category)))}}</p>
                        <p style="display:none;" class="mytown">{{$list->township}}</p>
                        <p style="display:none;" class="otherImg">{{$list->otherImage}}</p>
                        <p style="display:none;" class="mymainImg">{{$list->mainImage}}</p>
                        <p style="display:none;" class="myTaken">{{$list->taken}}</p>
                        <p style="display:none;" class="des">{{strip_tags($list->description)}}</p>
                        <p></p>
                        <div class="list-bg" style="background-image:url({{asset('public/adminUploads/'.$list->mainImage)}})">
                            <span>{{$list->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="info">
                            <h4 class="price"><?php
                                                        if ($list->money == 'mmk' AND $list->saleRent == 'for-rent') {
                                                        ?>
                                <span id="sortPrice">{{$list->price}}</span> {{$list->money}} <span id="perMonth">/mo</span>
                                <?php
                                                        }else if($list->money == 'mmk' AND $list->saleRent == 'for-sale'){
                                                        ?>
                                <span id="sortPrice">{{$list->price}}</span> {{$list->money}}
                                <?php
                                                        }else if($list->money == '$' AND $list->saleRent == 'for-rent'){
                                                        ?>
                                {{$list->money}} <span id="sortPrice">{{$list->price}}</span> <span id="perMonth">/mo</span>
                                <?php
                                                        }else if($list->money == '$' AND $list->saleRent == 'for-sale'){
                                                        ?>
                                {{$list->money}} <span id="sortPrice">{{$list->price}}</span>
                                <?php
                                                        }else{
                                                        ?>
                                {{$list->money}} {{$list->price}}
                                <?php
                                                        }
                                                        ?>
                            </h4>
                            <p class="rooms"><span class="bed">
                                <?php
                                if ($list->bedrooms != '') {
                                ?>
                                {{$list->bedrooms .' Bedrooms | '}}
                                <?php
                                    }
                                    ?>
                                
                                <?php
                                if ($list->bathrooms != '') {
                                ?>
                                {{$list->bathrooms .' Bathrooms | '}}
                                <?php
                                }
                                ?>
                                
                                <?php
                                    if ($list->floor != '') {
                                ?>
                                {{$list->floor}}
                                <?php
                                    }
                                ?>
                                
                                <?php
                                    if ($list->square_feet != '') {
                                ?>
                                {{$list->square_feet .' Sqrft | '}}
                                <?php
                                    }
                                ?>
                                <?php
                                    if ($list->carpark != '') {
                                ?>
                                {{$list->carpark .' Carpark '}}
                                <?php
                                    }
                                ?></span> </p>
                            <p class='types'><span class="listType1">{{str_replace('-',' ',$list->category)}}</span> <span
                                    class="listType2"> {{str_replace('-',' ',$list->saleRent)}}</span></p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="notfound">
                        <h3>No Listings Found</h3>
                        <a href="{{route('home')}}">Go back to home</a>
                    </div>
                    @endif
                </div>

                {{-- loading icon --}}
                <div class="loadIcon">
                    <img style="display: none;" class="myicon" src="{{asset('img/load.gif')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- for showing details --}}
<div class="listDetail">
    <button class="closeDetail">&times;</button>
    <div class="detailInside">

        <div class="row">
            <div class="col1">
                <div id="showMainImg" class="mainImg forMobile"></div>
                <div class="row1" id="showOtherImg">

                </div>
            </div>
            <span  class="pre"><i class="fas fa-angle-left"></i></span>
            <span  class="next"><i class="fas fa-angle-right"></i></span>
            <div class="col2">

                <div class="itemDetail">
                    <div class="row2">
                        <h1><span id="showCategory"></span></h1>
                        <div class="shareIcon">
                            <i id="shareIcon" class="fas fa-share"> Share</i>
                            <div class="shareItem">
                                <p class="copylink">Copy URL</p>

                                <p class="emailshare">Share on Email</p>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <p class="bed" id="showBed"></p>

                    <p class="address" id="showAddress"></p>
                    <div class="row3">
                        <p class="sr"><small>sa</small> <code id="showCat"></code> <span id="showSaleRent2"></span></p>
                        <p class="sa" id="showTaken"></p>
                    </div>
                    <hr>
                    <div class="row4">
                        <a class="requestApply" href="javascript:void(0)">Request to Apply</a>
                        <a class='takeTour' href="javascript:void(0)">Request a Tour</a>
                    </div>
                    <div class="moreDetail">
                        <div class="moreInside">
                            <li class="des">Description </li>
                            <div id="des">
                                <p id="showDes"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    {{-- share email popup --}}
    <div class="shareEmailPop">

        <button class="closeEmailShare">&times;</button>
        <div class="clear"></div>
        <form id="shareOnEmail" action="{{route('shareEmail')}}" method="POST">
            @csrf

            <label for="email">Email to share to</label>
            <small class="emailShareErr"></small>
            <input type="email" id="shareEmail" placeholder="Email Address">
            <input type="hidden" id="shareMailUrl">
            <textarea id="shareMessage" cols="30" rows="10" placeholder="Share Message"></textarea>
            <button id="emailShareBtn" type="submit">Send</button>
        </form>
        <div class="emailRes">

        </div>
    </div>

    {{-- request to apply pop up --}}
    <div class="requestToApply">
        <button class="closeRequestToApply">&times;</button>
        <form action="{{route('requestApply')}}" id="requestToApply" method="POST">
            @csrf
            <h3>Ready to Apply?</h3>
            <p>Enter your contact details and we will contact you soon.</p>
            <input type="hidden" id="rUrl">
            <textarea id="rSms" cols="30" rows="10"
                placeholder="Why would you like to apply this property? (optional)"></textarea>
            <small class="rError" id="rNameErr"></small>
            <input type="text" id="rName" placeholder="Enter Your Name">
            <small class="rError" id="rPhoneErr"></small>
            <input type="text" id="rPhone" placeholder="Your Phone Number">
            <small class="rError" id="rEmailErr"></small>
            <input type="email" id="rEmail" placeholder="Your Email">

            <button id="rtBtn" type="submit">Send Request</button>
        </form>
        <div class="rRes">

        </div>
    </div>


    {{-- request tour --}}

    <div class="requestTour-main">
        <div class="requestTour">

            <button class="closeRequestTour">&times;</button>
            <form id="tourRequest" action="{{route('requestTour')}}" method="POST">
                <h3>Reqeust a Tour</h3>
                @csrf

                <select id="tDate">
                    <option value="">-- Select Date --</option>
                    <option value="" id="dayone"></option>
                    <option value="" id="daytwo"></option>

                </select>
                <small class="tErr" id="tDateErr"></small>

                <select id="tTime">
                    <option value="">-- Select Time --</option>
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </select>
                <small class="tErr" id="tTimeErr"></small>

                <select id="tType">
                    <option value="">-- In person or Video Call --</option>
                    <option value="in person">In Person</option>
                    <option value="video call viber">Video Call (viber)</option>

                </select>
                <small class="tErr" id="tTypeErr"></small>

                <input type="text" id="tName" placeholder="Your Name">
                <small class="tErr" id="tNameErr"></small>

                <input type="text" id="tPhone" placeholder="Your Phone">
                <small class="tErr" id="tPhoneErr"></small>

                <input type="email" id="tEmail" placeholder="Your Email">
                <small class="tErr" id="tEmailErr"></small>
                <button id="trBtn" type="submit">Send Tour Request</button>
            </form>
            <div class="tReturn">

            </div>
        </div>
    </div>

</div>



@endsection

@section('script')
<script src="{{asset('script/jquery.js')}}" defer></script>
<script src="{{asset('script/property-search.js')}}" defer></script>
@endsection