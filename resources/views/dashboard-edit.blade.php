@extends('master')
@section('title')
<title>Edit</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('style/upload.css')}}">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
@endsection

@section('main-content')
<div class="uploadPage">
    <h1>Edit and Update Uploaded Listing</h1>

    <div>
        @foreach ($edit as $edits)
        <form id="userEdit" action="{{route('userUploadUpdate',$edits->id)}}" enctype="multipart/form-data">
                @csrf
                <small id="saleRentErr" class="uerr"></small>
                <select name="saleRent" id="">
                    <option value="">- Sale or Rent -</option>
                    <option value="for-sale">For Sale</option>
                    <option value="for-rent">For Rent</option>
                </select>
            
                <small id="categoryErr" class="uerr"></small>
                <select name="category" id="">
                    <option value="">- Select Category</option>
                    <option value="private-house">Private House</option>
                    <option value="condo">Condo</option>
                    <option value="apartment">Apartment</option>
                    <option value="shop-and-store">Shop and Store</option>
                    <option value="land">Land</option>
                    <option value="industrial-zone-and-warehouse">Industrial Zone and Warehouse</option>
                </select>
            
                <small id="addressErr" class="uerr"></small>
                <input value="{{$edits->address}}" name="address" type="text" id='address' placeholder="Address">
            
                <small id="townshipErr" class="uerr"></small>
                <input value="{{$edits->township}}" name="township" autocomplete="off" type="text" id="township" placeholder="Township Name">
            
                <div class="ygTowns">
                    <li class="town">Ahlone</li>
                    <li class="town">Bahan</li>
                    <li class="town">Botataung</li>
                    <li class="town">Dagon</li>
                    <li class="town">Dagon Myothit (east)</li>
                    <li class="town">Dagon Myothit (North)</li>
                    <li class="town">Dagon Myothit (South)</li>
                    <li class="town">Dawbon</li>
                    <li class="town">Hlaing</li>
                    <li class="town">Hlaingthaya</li>
                    <li class="town">Insein</li>
                    <li class="town">Kamaryut</li>
                    <li class="town">Kyauktada</li>
                    <li class="town">Kyeemyindaing</li>
                    <li class="town">Lanmadaw</li>
                    <li class="town">Latha</li>
                    <li class="town">Mayangone</li>
                    <li class="town">Mingaladon</li>
                    <li class="town">Mingalartaungnyunt</li>
                    <li class="town">North Okkalapa</li>
                    <li class="town">Pabedan</li>
                    <li class="town">Pazundaung</li>
                    <li class="town">Sangchaung</li>
                    <li class="town">Sekkan</li>
                    <li class="town">Shwepyithar</li>
                    <li class="town">South Okkalapa</li>
                    <li class="town">Tamwe</li>
                    <li class="town">Thaketa</li>
                    <li class="town">Thingangyun</li>
                    <li class="town">Yankin</li>
                    <li class="town">Other Township</li>
                </div>
                <input value="{{$edits->price}}" name="price" type="text" id="price" placeholder="Price">
                <select id="moneySign" name="money">
                    <option value="mmk">mmk</option>
                    <option value="$">$</option>
                </select>
                <label for="">Main Feature Image</label>
                <small id="mainImageErr" class="uerr"></small>
                <input name="mainImage" type="file" id="mainImage" accept="image/*">
            
                <small id="otherImageErr" class="uerr"></small>
                <input name="otherImage[]" multiple type="file" id="otherImage" class="form-control" onchange="selectImage()"
                    style="display:none;">
                <button type="button" onclick="document.getElementById('otherImage').click()">Upload Multiple
                    Images</button><br>
            
                <div class="imgPreview">
                    <div class="row1" id="imgPre">
            
                    </div>
                </div>
                <br>
                <div class="col1">
                    <div class="bedRoom">
                        <input value="{{$edits->bedrooms}}" name="bedroom" type="text" id="bedRoom" placeholder="Bed Rooms">
                    </div>
                    <div class="bathRoom">
                        <input value="{{$edits->bathrooms}}" name="bathroom" type="text" id="bedRoom" placeholder="Bed Rooms">
                    </div>
                </div>
                <div class="col1">
                    <div class="floor">
                        <input value="{{$edits->floor}}" name="floor" type="text" id="floor" placeholder="Floor">
                    </div>
                    <div class="feet">
                        <input value="{{$edits->square_feet}}" name="squarefeet" type="text" id="feet" placeholder="Square Feet">
                    </div>
                </div>
                <small id="descriptionErr" class="uerr"></small>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description">{{$edits->description}}</textarea>
                <small id="termErr" class="uerr"></small>
                <input name="term" type="checkbox" id="terms" checked> <a href="{{route('condition')}}"> Accept Terms and Conditions</a><br>
                <button id="userUpdateBtn" type="submit">Update</button>
            </form>
            
        @endforeach
        <div class="returnSms">

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('script/jquery.js')}}"></script>
<script src="{{asset('script/upload.js')}}"></script>
@endsection