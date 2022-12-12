@extends('master')
@section('title')
    <title>Uploaded Listing Detail</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('style/profile.css')}}">
@endsection

@section('main-content')
@foreach ($detail as $details)
    <div class="postDetail">
        <div class="row1">
            <h4>Post Detail of {{str_replace(' ',' ',ucwords(str_replace('-',' ',$details->category)))}},
                {{str_replace(' ',' ',ucwords(str_replace('-',' ',$details->saleRent)))}}</h4>
            <a href="{{route('userUploadEdit',$details->id)}}">Edit</a>
            <form action="{{route('userUploadDelete',$details->id)}}" method="POST" id="delete-{{$details->id}}" style="display: none;">
                @csrf
            </form>
            <button onclick="if(confirm('are you sure to delete this?')){event.preventDefault();document.getElementById('delete-{{$details->id}}').submit()}else{event.preventDefault();}">Delete</button>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <p>Price - {{$details->money}} {{$details->price}}</p>
                <p>Address - {{$details->address}}, {{$details->township}}</p>
            </div>
            <div class="col">
                <p>
                    <?php
                    if ($details->bedrooms != '') {
                    ?>
                        {{$details->bedrooms .' Bedrooms | '}}
                        <?php
                        }
                        ?>
                        
                        <?php
                        if ($details->bathrooms != '') {
                        ?>
                        {{$details->bathrooms .' Bathrooms | '}}
                        <?php
                        }
                        ?>
                        
                        <?php
                            if ($details->floor != '') {
                        ?>
                        {{$details->floor}}
                        <?php
                            }
                        ?>
                        
                        <?php
                            if ($details->square_feet != '') {
                        ?>
                        {{$details->square_feet .' Sqrft | '}}
                        <?php
                            }
                        ?>
                        <?php
                            if ($details->carpark != '') {
                        ?>
                        {{$details->carpark .' Carpark '}}
                        <?php
                            }
                        ?>
                </p>
            </div>
            <div class="col">
                <?php
                if ($details->approve == 0) {
                ?>
                <p class="app">Not Approved Yet</p>
                <?php
                }else{
                ?>
                <p class="not-app">Approved Already</p>
                <?php
                }
                ?>
            </div>
        </div>
        <p>Description</p>
        <p class="des">{{$details->description}}</p>
        <hr>
        <h5>Main Image</h5>
        <div class="main" style="background-image:url({{asset('storage/adminUploads/'.$details->mainImage)}})">
    
        </div>
        <h5>Other Images</h5>
        <div class="row2">
            @php
            $loopImg = explode('|',$details->otherImage);
            @endphp
            @foreach ($loopImg as $otherImg)
            <div class="other" style="background-image:url({{asset($otherImg)}})">
            
            </div>
            @endforeach
        </div>
        <br>

        <button onclick="window.history.back()" class="goBack">Go Back</button>
    </div>
@endforeach

@endsection