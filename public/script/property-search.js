let town = document.querySelector('#searchTown');
let towns = document.querySelectorAll('.town');
let ygTowns = document.querySelector('.ygTowns');
town.addEventListener('keyup', function () {
    ygTowns.style.display = "block";
    let val = town.value.toLowerCase();

    if (val == "") {
        ygTowns.style.display = "none";
    } else {
        Array.from(towns).forEach((mytowns) => {
            let lower = mytowns.firstChild.textContent.toLowerCase();

            if (lower.indexOf(val) != -1) {
                mytowns.style.display = "block";
            } else {
                mytowns.style.display = "none";
            }

            // when click
            mytowns.addEventListener("click", function () {
                let getTxt = mytowns.firstChild.textContent;
                town.value = getTxt;
                ygTowns.style.display = "none";
            });
        });
    }
});



let SR = document.querySelector('#searchSaleRent');
let saleRent = document.querySelector('.saleRent');
let srList = document.querySelectorAll('.sr');
SR.addEventListener('click', function () {
    saleRent.style.display = "block";
    Array.from(srList).forEach((mylist) => {
        mylist.addEventListener('click', function () {
            let getVal = mylist.firstChild.textContent;
            SR.value = getVal;
            saleRent.style.display = "none";
        });
    });
});



let ST = document.querySelector('#searchType');
let proType = document.querySelector('.proType');
let ptList = document.querySelectorAll('.pt');
ST.addEventListener('click', function () {
    proType.style.display = "block";
    Array.from(ptList).forEach((mylist) => {
        mylist.addEventListener('click', function () {
            let getVal = mylist.firstChild.textContent;
            ST.value = getVal;
            proType.style.display = "none";
        });
    });
});



// show detail
function showDetailPopup() {
    let listItems = document.querySelectorAll('#listItems');
    for (let i = 0; i < listItems.length; i++) {
        listItems[i].addEventListener('click', showDetail);

        function showDetail(e) {
            let listDetail = document.querySelector('.listDetail');
            listDetail.style.display = "block";
            let body = document.body;
            body.style.overflow = 'hidden';

            let getId = this.querySelector('.myid').textContent;
            let getAddress = this.querySelector('.address').textContent;
            let getType = this.querySelector('.mytype').textContent;
            let getCat = this.querySelector('.mycat').textContent;
            let getTown = this.querySelector('.mytown').textContent;
            let getOtherImg = this.querySelector('.otherImg').textContent;
            let getMainImg = this.querySelector('.mymainImg').textContent;
            let getDes = this.querySelector('.des').textContent;
            let getPrice = this.querySelector('.price').textContent;
            let getBed = this.querySelector('.bed').textContent;
            let getTaken = this.querySelector('.myTaken').textContent;

            let domain = 'http://localhost:8000/public/adminUploads/';
            let domain2 = 'http://localhost:8000/';

            document.querySelector('#showMainImg').setAttribute('style', 'background-image:url(' + domain + getMainImg + ')');

            let forOtherImg = document.querySelector('#showOtherImg');
            let ExImg = getOtherImg.split('|');
            let imgOut = '';
            ExImg.forEach((myimages) => {
                imgOut += `
                        <div class="col">
                        <div class="forMobile" id="imgClick" style="background-image: url('${domain2}${myimages}')"></div>
                    </div>`;
            });
            forOtherImg.innerHTML = imgOut;

            document.querySelector('#showCategory').innerHTML = getPrice;
            // document.querySelector('#showPrice').innerHTML = getPrice;
            document.querySelector('#showBed').innerHTML = `<span>${getBed}</span>`;
            document.querySelector('#showSaleRent2').innerText = getType.toLowerCase();
            document.querySelector('#showAddress').innerText = getAddress + ', ' + getTown;
            document.querySelector('#showDes').innerText = getDes;

            document.querySelector('#showCat').innerText = getCat;

            if (getTaken == 0) {
                document.querySelector('#showTaken').innerText = 'Available';
            } else if (getTaken == 1 && saleRent == 'for-rent') {
                document.querySelector('#showTaken').innerText = 'Rent Out';
            } else {
                document.querySelector('#showTaken').innerText = 'Sold Out';
            }

            history.pushState({}, null, getId);

            // mobile view runslide detail images
            let mobileImages = document.querySelectorAll('.forMobile');
            let count = 1;

            let pre = document.querySelector('.pre');
            let next = document.querySelector('.next');
            pre.addEventListener('click', preslide);
            next.addEventListener('click', nextslide);
            function preslide() {
                count += -1;
                mainslide(count);
                // console.log(mobileImages);
            }
            function nextslide() {
                count += 1;
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


        }
    }

}

showDetailPopup();
// closeDetailPopup();

let closeDetail = document.querySelector('.closeDetail');
closeDetail.addEventListener('click', function () {
    let listDetail = document.querySelector('.listDetail');
    listDetail.style.display = "none";
    let body = document.body;
    body.style.overflowY = "scroll";

    window.history.back();
});



// share
let shareIcon = document.querySelector('#shareIcon');
let shareItem = document.querySelector('.shareItem');
shareIcon.addEventListener('click', function () {
    shareItem.classList.toggle('newShareItem');
});

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








