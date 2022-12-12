// scroll
window.addEventListener('scroll', function () {
    let allEl = document.documentElement;
    // console.log(allEl);
    let top = allEl.scrollTop || document.body.scrollTop;
    if (top > 260) {
        let scrollNav = document.querySelector('.scrollNav');
        scrollNav.classList.add('newScrollNav');
    } else {
        let scrollNav = document.querySelector('.scrollNav');
        scrollNav.classList.remove('newScrollNav');
    }
});

//subscribe
$('#subForm').on('submit',subscribe);
function subscribe(e){
    e.preventDefault();
    let email = $('#email').val();
    let _token = $('#token').val();

    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:{email:email,_token:_token},
        beforeSend:function(){
            $('#subBtn').text('Please Wait...');
        },
        success:function(data){
            $('.subErr').html('<span>'+data.success+'</span>');
            $('#subBtn').text('Subscribe');
            $('#subForm')[0].reset();
        },

        error: function (response){
            $('.subErr').html('<small>'+response.responseJSON.errors.email+'</small>');
        }

    });
    
}
function closeSubSuccess(){
    document.querySelector('.sub-success').style.display="none";
}