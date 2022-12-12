let township = document.querySelector('#township');
let ygTowns = document.querySelector('.ygTowns');
let allTowns = document.querySelectorAll('.town');

township.addEventListener('keyup',function(){
    ygTowns.style.display="block";
    let inputVal = township.value.toLowerCase();

    if(inputVal == ""){
        ygTowns.style.display = "none";
    }else{

        Array.from(allTowns).forEach((mytowns)=>{
            let townTxt = mytowns.firstChild.textContent.toLowerCase();

            if(townTxt.indexOf(inputVal) != -1){
                mytowns.style.display="block";
            }else{
                mytowns.style.display = "none";
            }
        });
    }

    Array.from(allTowns).forEach((getAll)=>{
        getAll.addEventListener('click',function(){
            let val = getAll.firstChild.textContent;
            township.value = val;
            ygTowns.style.display = "none";
        });
    });

});



var images = [];
function selectImage() {
    var image = document.getElementById('otherImage').files;
    for (let i = 0; i < image.length; i++) {
        if (check_duplicate(image[i].name)) {
            images.push({
                'name': image[i].name,
                'url': URL.createObjectURL(image[i]),
                'file': image[i]
            });
        } else {
            alert(image[i].name + ' is already exists');
        }
    }
    // document.getElementById('otherImage').value = '';
    document.getElementById('imgPre').innerHTML = showImage();
}

function showImage() {
    var image = "";
    images.forEach((getImg) => {
        image += `<div class="col">
                    <img src="${getImg.url}" alt="">
                </div>`;
    });

    return image;
}


function deleteImg(toDel) {

    images.splice(toDel, 1);
    var image = document.getElementById('otherImage').files;

    let toRemove = Array.from(image);
    toRemove.splice(toDel, 1);

    console.log(toRemove);
    document.getElementById('imgPre').innerHTML = showImage();
}

function check_duplicate(name) {
    var image = true;
    if (images.length > 0) {
        for (e = 0; e < images.length; e++) {
            if (images[e].name == name) {
                image = false;
                break;
            }
        }
    }

    return image;
}


$('#userUpload').on('submit', uploadData);

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
        cache: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
            $('#userPostBtn').text('Uploading, Please Wait...');
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
            $('#termErr').text(response.responseJSON.errors.term);
            $('#userPostBtn').text('Uploading Error');
        },
        success: function (data) {
            $('.returnSms').html('<p class="mysms">' + data.success +'</p>');
            $('#userUpload')[0].reset();
            $('#userPostBtn').text('Upload');
            $('.imgPreview').hide();
        }
    });

};



$('#userEdit').on('submit', uploadData);

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
        cache: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
            $('#userUpdateBtn').text('Updating, Please Wait...');
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
            $('#termErr').text(response.responseJSON.errors.term);
            $('#userUpdateBtn').text('Update Error');
        },
        success: function (data) {
            $('.returnSms').html('<p class="mysms">' + data.success + '</p>');
            $('#userUpload')[0].reset();
            $('#userUpdateBtn').text('Update');
            $('.imgPreview').hide();
        }
    });

};



