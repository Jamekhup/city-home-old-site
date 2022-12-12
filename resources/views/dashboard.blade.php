@extends('master')
@section('title')
<title>User Profile Page</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('style/profile.css')}}">    
@endsection

@section('main-content')
    <div class="proPage">
        <h4>Your Profile Page</h4>
        <hr>
        <div class="row1">
            <div>
                <p>Name - {{ucwords(Auth()->user()->name)}}</p>
                <p>Email - {{Auth()->user()->email}}</p>
                
            </div>
        </div>
        <br>
        <h4>Your Recent Posts</h4>
        <hr>
        @if (session()->has('sms'))
            <div class="pop">
                <p>{{session()->get('sms')}}</p>
                <span class="closeSms">&times;</span>
            </div>
        @endif
        <div class="row">
            
            @if (count($post) > 0)
                @foreach ($post as $posts)
                    <div class="col">
                        <a href="{{route('userUploadDestial',$posts->id)}}">
                            <div class="list-bg" style="background-image:url({{asset('storage/adminUploads/'.$posts->mainImage)}})">
                                <span>{{$posts->created_at->diffForHumans()}}</span>
                            </div>
                            <h3 class="price"><?php
                                                        if ($posts->money == 'mmk' AND $posts->saleRent == 'for-rent') {
                                                        ?>
                                <span id="sortPrice">{{$posts->price}}</span> {{$posts->money}} <span id="perMonth">/mo</span>
                                <?php
                                                        }else if($posts->money == 'mmk' AND $posts->saleRent == 'for-sale'){
                                                        ?>
                                <span id="sortPrice">{{$posts->price}}</span> {{$posts->money}}
                                <?php
                                                        }else if($posts->money == '$' AND $posts->saleRent == 'for-rent'){
                                                        ?>
                                {{$posts->money}} <span id="sortPrice">{{$posts->price}}</span> <span id="perMonth">/mo</span>
                                <?php
                                                        }else if($posts->money == '$' AND $posts->saleRent == 'for-sale'){
                                                        ?>
                                {{$posts->money}} <span id="sortPrice">{{$posts->price}}</span>
                                <?php
                                                        }else{
                                                        ?>
                                {{$posts->money}} {{$posts->price}}
                                <?php
                                                        }
                                                        ?>
                            </h3>
                            <p class="rooms"><span class="bed">
                            <?php
                            if ($posts->bedrooms != '') {
                            ?>
                                {{$posts->bedrooms .' Bedrooms | '}}
                                <?php
                                }
                                ?>
                                
                                <?php
                                if ($posts->bathrooms != '') {
                                ?>
                                {{$posts->bathrooms .' Bathrooms | '}}
                                <?php
                                }
                                ?>
                                
                                <?php
                                    if ($posts->floor != '') {
                                ?>
                                {{$posts->floor}}
                                <?php
                                    }
                                ?>
                                
                                <?php
                                    if ($posts->square_feet != '') {
                                ?>
                                {{$posts->square_feet .' Sqrft | '}}
                                <?php
                                    }
                                ?>
                                <?php
                                    if ($posts->carpark != '') {
                                ?>
                                {{$posts->carpark .' Carpark '}}
                                <?php
                                    }
                                ?>    
                            </span> </p>
                            
                            <p class='types'><span class="postsType1">{{str_replace('-',' ',$posts->category)}}</span> <span class="postsType2">
                                    {{str_replace('-',' ',$posts->saleRent)}}</span></p>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="no-post">
                    <h5>You haven't uploaded any lists</h5>
                </div>
            @endif
        </div>
    </div>


    @section('script')
    <script>
        let closeSMS = document.querySelector('.closeSms');
        closeSMS.addEventListener('click',function(){
            document.querySelector('.pop').style.display="none";
        });
    </script>
    @endsection
@endsection