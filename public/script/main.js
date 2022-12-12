var src = window.matchMedia("(max-width: 710px)");
addIcon(src);
src.addListener(addIcon);



function addIcon(getSize){
    if(getSize.matches){
        let a1 = document.querySelector('.buya');
        let a2 = document.querySelector('.renta');
        let a3 = document.querySelector('.adsa');
        a1.insertAdjacentHTML('afterend', '<i class="fas fa-angle-down"></i>');
        a2.insertAdjacentHTML('afterend', '<i class="fas fa-angle-down"></i>');
        a3.insertAdjacentHTML('afterend', '<i class="fas fa-angle-down"></i>');
    }else{
        let downIcon = document.querySelectorAll('.fa-angle-down');
        Array.from(downIcon).forEach((icons)=>{
            icons.remove();
        });
    }
}

let buy = document.querySelector('.buy');
let rent = document.querySelector('.rent');
let advertise = document.querySelector('.advertise');

buy.addEventListener('click',function(){
    let bDrop = document.querySelector('.buyDrop');
    bDrop.classList.toggle('newBuy');
});

rent.addEventListener('click', function () {
    
    let rDrop = document.querySelector('.rentDrop');
    rDrop.classList.toggle('newRent');
});

advertise.addEventListener('click', function () {
    let adsDrop = document.querySelector('.adsDrop');
    adsDrop.classList.toggle('newAds');
});

// click toggle menu btn
let icons = document.querySelector('.icons');
icons.addEventListener('click',function(){
    let mainMenu = document.querySelector('.mainNav');
    let mobile = document.querySelector('.mobile');
    mainMenu.classList.toggle('newMainMenu');
    mobile.classList.toggle('newMobile');
    icons.classList.toggle('newIcons');

    let body = document.getElementsByTagName('body');
    body[0].classList.toggle('dScroll');
});

let all = document.querySelector('#mainBody');
console.log(all.scrollHeight);
if (all.scrollHeight < 500) {
    document.querySelector('.footer').style.display="none";
}else{
    document.querySelector('.footer').style.display = "block";
}


