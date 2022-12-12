// mobile view runslide detail images
let mobileImages = document.querySelectorAll('.forMobile');
for (i = 0; i < mobileImages.length; i++) {
    console.log(mobileImages[i]);
}
let count = 1;
function runslide(get) {
    count += get;
    mainslide(count);
    // console.log(mobileImages);
}

function mainslide(n) {
    let i;
    for (i = 0; i < mobileImages.length; i++) {
        mobileImages[i].style.display = "none";
    }

    if (n > mobileImages.length) {
        count = 1;
    }

    if (n < 1) {
        count = mobileImages.length;
    }

    mobileImages[count - 1].style.display = "block";
}

// share
let shareIcon = document.querySelector('#shareIcon');
let shareItem = document.querySelector('.shareItem');
shareIcon.addEventListener('click', function () {
    shareItem.classList.toggle('newShareItem');
});

//link copy
var $temp = $("<input>");
var $url = $(location).attr('href');

$('.copylink').on('click', function () {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    $(".copylink").text("URL copied!");

    setInterval(() => {
        $('.copylink').text('Copy URL')
    }, 1000);
})

// email share popuo
let emailshare = document.querySelector('.emailshare');
let shareEmailPop = document.querySelector('.shareEmailPop');
emailshare.addEventListener('click', function () {
    document.querySelector('#shareMailUrl').value = window.location.href;
    shareEmailPop.style.display = "block";
    shareItem.classList.remove('newShareItem');
    // requestAgent.style.display = "none";
    // shareEmailPop.style.display = "none";
    requestToApply.classList.remove('newRequestToApply');
});

// close email 
let closeEmailShare = document.querySelector('.closeEmailShare');
closeEmailShare.addEventListener('click', function () {
    shareEmailPop.style.display = "none";
});



$('#shareOnEmail').on('submit', function (e) {
    e.preventDefault();

    let shareEmail = $('#shareEmail').val();
    let shareMailUrl = $('#shareMailUrl').val();
    let shareMessage = $('#shareMessage').val();
    let token = $('#token').val();

    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: { email: shareEmail, url: shareMailUrl, sms: shareMessage },
        beforeSend: function () {
            $('#emailShareBtn').text('Please Wait...');
        },
        success: function (data) {
            $('.emailRes').html('<p class="emailReturn">' + data.success + '</p>');
            $('#shareOnEmail')[0].reset();
            $('#emailShareBtn').text('Send');
        },
        error: function (response) {
            $('.emailShareErr').text(response.responseJSON.errors.email);
            $('#emailShareBtn').text('Send');
        }
    });



});

//end email share


// request apply
let requestApply = document.querySelector('.requestApply');
let requestToApply = document.querySelector('.requestToApply');
requestApply.addEventListener('click', function () {
    requestToApply.classList.add('newRequestToApply');
    shareEmailPop.style.display = "none";
    document.querySelector('#rUrl').value = document.location.href;
});

// close}
let closeRequestToApply = document.querySelector('.closeRequestToApply');
closeRequestToApply.addEventListener('click', function () {
    requestToApply.classList.remove('newRequestToApply');
});

$('#requestToApply').on('submit', function (e) {
    e.preventDefault();
    let url = $('#rUrl').val();
    let sms = $('#rSms').val();
    let name = $('#rName').val();
    let email = $('#rEmail').val();
    let phone = $('#rPhone').val();

    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: { url: url, sms: sms, name: name, email: email, phone: phone },
        beforeSend: function () {
            $('#rtBtn').text('Please Wait...');
        },
        success: function (data) {
            $('.rRes').html('<p class="rReturn">' + data.success + '</p>');
            $('#requestToApply')[0].reset();
            $('#rtBtn').text('Send Request');
        },
        error: function (response) {
            $('#rNameErr').text(response.responseJSON.errors.name);
            $('#rPhoneErr').text(response.responseJSON.errors.phone);
            $('#rEmailErr').text(response.responseJSON.errors.email);
            $('#rtBtn').text('Send Request');
        }
    });


});


// request Tour pop up
let takeTour = document.querySelector('.takeTour');
let requestTour_Main = document.querySelector('.requestTour-main');

takeTour.addEventListener('click', function () {
    requestTour_Main.classList.add('newRequestTour');
    shareEmailPop.style.display = "none";
    requestToApply.classList.remove('newRequestToApply');
});

// close
let closeRequestTour = document.querySelector('.closeRequestTour');
closeRequestTour.addEventListener('click', function () {
    requestTour_Main.classList.remove('newRequestTour');
});

$('#tourRequest').on('submit', function (e) {
    e.preventDefault();
    let date = $('#tDate').val();
    let time = $('#tTime').val();
    let type = $('#tType').val();
    let name = $('#tName').val();
    let phone = $('#tPhone').val();
    let email = $('#tEmail').val();

    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: { date: date, time: time, type: type, name: name, phone: phone, email: email },
        beforeSend: function () {
            $('#trBtn').text('Please Wait...');
        },
        success: function (data) {
            $('.tReturn').html('<p class="tsuccess">' + data.success + '</p>');
            $('#tourRequest')[0].reset();
            $('#trBtn').text('Send Tour Request');
        },
        error: function (response) {
            $('#tDateErr').text(response.responseJSON.errors.date);
            $('#tTimeErr').text(response.responseJSON.errors.time);
            $('#tTypeErr').text(response.responseJSON.errors.type);
            $('#tNameErr').text(response.responseJSON.errors.name);
            $('#tPhoneErr').text(response.responseJSON.errors.phone);
            $('#tEmailErr').text(response.responseJSON.errors.email);
            $('#trBtn').text('Send Tour Request');
        }
    });


});




// calculate for today to put in request Tour
let td = new Date();
let today_date = td.getDate(); //1-31
let today_day = td.getDay();  //0-6

let month = td.getMonth();
let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

let getMonth = months[month];
let getTodayDay = days[today_day];
document.querySelector('#dayone').innerHTML = `Today, ${getTodayDay}, ${getMonth} ${today_date}`;
document.querySelector('#dayone').value = `Today, ${getTodayDay}, ${getMonth} ${today_date}`;

// tomorrow
const tomorrowDate = new Date(td);
tomorrowDate.setDate(tomorrowDate.getDate() + 1);
let tomorrow_date = tomorrowDate.getDate();

const tomorrowDay = new Date(td);
tomorrowDay.setDate(tomorrowDay.getDate() + 1);
let tomorrow_day = tomorrowDay.getDay();
let getTomorrowDay = days[tomorrow_day];

const tomorrowMonth = new Date(td);
tomorrowMonth.setDate(tomorrowMonth.getDate() + 1);
let tomorrow_month = tomorrowMonth.getMonth();
let getTomorrowMonth = months[tomorrow_month];

document.querySelector('#daytwo').innerHTML = `Tomorrow, ${getTomorrowDay}, ${getTomorrowMonth} ${tomorrow_date}`;
document.querySelector('#daytwo').value = `Tomorrow, ${getTomorrowDay}, ${getTomorrowMonth} ${tomorrow_date}`;

//loop other dates
let tDate = document.querySelector('#tDate');

for (let i = 2; i < 6; i++) {
    const loopDate = new Date(td);
    loopDate.setDate(loopDate.getDate() + i);
    let loop_date = loopDate.getDate();

    const loopDay = new Date(td);
    loopDay.setDate(loopDay.getDate() + i);
    let loop_day = loopDay.getDay();
    let getLoopDay = days[loop_day];

    const loopMonth = new Date(td);
    loopMonth.setDate(loopMonth.getDate() + i);
    let loop_month = loopMonth.getMonth();
    let getLoopMonth = months[loop_month];

    let option = document.createElement('option');
    let txt = `${getLoopDay}, ${getLoopMonth} ${loop_date}`;
    option.value = txt;

    option.appendChild(document.createTextNode(txt));
    tDate.appendChild(option);

}




// load more
function loadMoreData(page) {
    $.ajax({
        url: '?page=' + page,
        type: 'get',
        beforeSend: function () {
            $('.myicon').show();
        }
    })
        .done(function (data) {
            if (data.html == "") {
                $('.loadIcon').html('<small>No more data to load</small>');
                return;
            }
            $('.myicon').hide();
            $('#loadMore').append(data.html);
            showDetailPopup();
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('server not responding');
        })
}

let page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;

        loadMoreData(page);

    }
});


// end load more data ajax







