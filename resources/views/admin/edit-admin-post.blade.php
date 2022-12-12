@extends('admin.adminMaster')

@section('adminStyle')
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/summernote/summernote.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/summernote/summernote-bs3.css')}}" />
<link rel="stylesheet" href="{{asset('style/customadmin.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('main-section')
<div class="row">
    <div class="col-xs-12">
        <section class="panel">
            <header class="panel-heading" id="pnhead">
                <h2 class="panel-title" id="pntitle">Edit Post</h2>
            </header>
            <div class="panel-body">
                <form action="{{route('dashboard.update',$edit->id)}}" class="form-horizontal form-bordered" id="editPost"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sale or Rent and Category</label>
                        <div class="col-md-2" id="space">
                            <select name="saleRent" id="saleRent" class="form-control">
                                <option value="">- Sale or Rent -</option>
                                <option value="for-sale">For Sale</option>
                                <option value="for-rent">For Rent</option>
                            </select>
                            <small id="saleRentErr" class="uerr"></small>
                        </div>
                        <div class="col-md-6">
                            <select name="category" id="category" class="form-control">
                                <option value="">- Select Category</option>
                                <option value="private-house">Private House</option>
                                <option value="condo">Condo</option>
                                <option value="apartment">Apartment</option>
                                <option value="shop-and-store">Shop and Store</option>
                                <option value="land">Land</option>
                                <option value="industrial-zone-and-warehouse">Industrial Zone and Warehouse</option>
                            </select>
                            <small id="categoryErr" class="uerr"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>
                        <div class="col-md-8">
                            <input value="{{$edit->address}}" name="address" type="text" id="address" class="form-control"
                                placeholder="Enter Address">
                            <small id="addressErr" class="uerr"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Select Township</label>
                        <div class="col-md-8">
                            <select name="township" data-plugin-selectTwo class="form-control populate" id="township">
                                <optgroup label="Yangon Townships">
                                    <option value="Ahlone" class="town">Ahlone</option>
                                    <option value="Bahan" class="town">Bahan</option>
                                    <option value="Botatuang" class="town">Botataung</option>
                                    <option value="Dagon" class="town">Dagon</option>
                                    <option value="Dagon Myothit (east)" class="town">Dagon Myothit (east)</option>
                                    <option value="Dagon Myothit (North)" class="town">Dagon Myothit (North)</option>
                                    <option value="Dagon Myothit (South)" class="town">Dagon Myothit (South)</option>
                                    <option value="Dawbon" class="town">Dawbon</option>
                                    <option value="Hlaing" class="town">Hlaing</option>
                                    <option value="Hlaingthaya" class="town">Hlaingthaya</option>
                                    <option value="Insein" class="town">Insein</option>
                                    <option value="Kamaryut" class="town">Kamaryut</option>
                                    <option value="Kyauktada" class="town">Kyauktada</option>
                                    <option value="Kyeemyindaing" class="town">Kyeemyindaing</option>
                                    <option value="Lanmadaw" class="town">Lanmadaw</option>
                                    <option value="Latha" class="town">Latha</option>
                                    <option value="Mayangone" class="town">Mayangone</option>
                                    <option value="Mingaladon" class="town">Mingaladon</option>
                                    <option value="Mingalartaungnyunt" class="town">Mingalartaungnyunt</option>
                                    <option value="North Okkalapa" class="town">North Okkalapa</option>
                                    <option value="Pabedan" class="town">Pabedan</option>
                                    <option value="Pazundaung" class="town">Pazundaung</option>
                                    <option value="Sangchaung" class="town">Sangchaung</option>
                                    <option value="Sekkan" class="town">Sekkan</option>
                                    <option value="Shwepyithar" class="town">Shwepyithar</option>
                                    <option value="South Okkalapa" class="town">South Okkalapa</option>
                                    <option value="Tamwe" class="town">Tamwe</option>
                                    <option value="Thaketa" class="town">Thaketa</option>
                                    <option value="Thingangyun" class="town">Thingangyun</option>
                                    <option value="Yankin" class="town">Yankin</option>
                                    <option value="Other Township" class="town">Other Township</option>
                                </optgroup>

                            </select>
                            <small id="townshipErr" class="uerr"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Price and Currenty</label>
                        <div class="col-md-4" id="space">
                            <input value="{{$edit->price}}" name="price" type="text" id="price" class="form-control" placeholder="Price">
                            <small id="priceErr" class="uerr"></small>
                        </div>
                        <div class="col-md-4">
                            <select name="money" id="money" class="form-control">
                                <option value="mmk">mmk</option>
                                <option value="$">$</option>
                            </select>
                            <small id="moneyErr" class="uerr"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Bed Room, Bath Room</label>
                        <div class="col-md-4" id="space">
                            <input value="{{$edit->bedrooms}}" name="bedroom" type="text" id="bedroom" class="form-control" placeholder="Bed Rooms">
                        </div>
                        <div class="col-md-4">
                            <input value="{{$edit->bathrooms}}" name="bathroom" type="text" id="bathroom" class="form-control"
                                placeholder="Bath Rooms">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Floor/Story and Square Feet</label>
                        <div class="col-md-4" id="space">
                            <input value="{{$edit->floor}}" name="floor" type="text" id="floor" class="form-control" placeholder="1st floor/3-story">
                        </div>
                        <div class="col-md-4">
                            <input value="{{$edit->square_feet}}" name="squarefeet" type="text" id="squarefeet" class="form-control"
                                placeholder="Square Feet">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Car Parking</label>
                        <div class="col-md-8">
                            <input name="carpark" value="{{$edit->carpark}}" type="text" id="carpark" class="form-control" placeholder="Car Parking">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-8">
                            <textarea name='description' class='form-control' style="height:250px">{{$edit->description}}</textarea>
                        </div>
                        <small id="descriptionErr" class="uerr"></small>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Main Feature Image (1 only)</label>
                        <div class="col-md-8">
                            <input name="mainImage" type="file" id="mainImage" class="form-control">
                            <small id="mainImageErr" class="uerr"></small>
                        </div>
                    </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Other multiple Images</label>
                    <div class="col-md-8">
                        <input name="otherImage[]" multiple type="file" id="otherImage" class="form-control" onchange="selectImage()"
                            style="display:none;">
                        <button type="button" class="btn btn-dark" onclick="document.getElementById('otherImage').click()">Upload
                            Multiple Images</button><br>
                        <small id="otherImageErr" class="uerr"></small>
                        <span>Image Preview</span><br>
                        <div class="imgPreview">
                            <div class="row1" id="imgPre">
                
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="col-md-3">
                            <a href="{{route('dashboard.index')}}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="col-md-8">
                            <button id="adminUpdateBtn" type="submit" class="btn btn-block btn-info">Update</button>
                        </div>
                    </div>
                </form>
                <div class="returnSms"></div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('adminScript')


<!-- Specific Page Vendor -->
<script src="{{asset('assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js')}}"></script>
<script src="{{asset('assets/vendor/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/vendor/summernote/summernote.js')}}"></script>

<script src="{{asset('assets/javascripts/forms/examples.advanced.form.js')}}" />
</script>
<script src="{{asset('script/adminupload.js')}}"></script>
<script>
    $('#editPost').on('submit', uploadData);
    
    function uploadData(e) {
    e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            cache:false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
            $('#adminUpdateBtn').text('Updating, Please Wait...');
            },
            error: function (response) {
                $('#saleRentErr').text(response.responseJSON.errors.saleRent);
                $('#categoryErr').text(response.responseJSON.errors.category);
                $('#addressErr').text(response.responseJSON.errors.address);
                $('#twonshipErr').text(response.responseJSON.errors.twonship);
                $('#priceErr').text(response.responseJSON.errors.price);
                $('#moneyErr').text(response.responseJSON.errors.money);
                $('#descriptionErr').text(response.responseJSON.errors.description);
                $('#mainImageErr').text(response.responseJSON.errors.mainImage);
                $('#otherImageErr').text(response.responseJSON.errors.otherImage);
                $('#adminUpdateBtn').text('Update');
            },
            success: function (data) {
                $('.returnSms').html('<p class="mysms">' + data.success + '</p>');
                $('#uploadPost')[0].reset();
                $('#adminUpdateBtn').text('Update');
            }
        });
    
    }
</script>

@endsection