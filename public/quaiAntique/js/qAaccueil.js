/*slide*/
/*cadre*/
window.addEventListener('scroll',Scroll);
function Scroll(){
    /*slide*/
    if(window.scrollY>0){
        document.getElementById('nav').classList.remove('in-slide');
        document.getElementById('barre-haut').classList.add('off-slide');
        document.getElementById('cadre-bas').classList.add('off-slide');
        galerieOver();
    }else{
        document.getElementById('nav').classList.add('in-slide');
        document.getElementById('barre-haut').classList.remove('off-slide');
        document.getElementById('cadre-bas').classList.remove('off-slide');
        galerieOut();
    }

    /*Menu & Speach & Avis*/
    let qaMenu=document.getElementById('menu'),
        qaSpeach=document.getElementById('qaSpeach'),
        qaAvis=document.getElementById('qaAvis'),
        positionMenu=window.innerHeight-qaMenu.getBoundingClientRect().top,
        positionSpeach=window.innerHeight-qaSpeach.getBoundingClientRect().top,
        positionAvis=window.innerHeight-qaAvis.getBoundingClientRect().top;
    if(positionMenu>300){document.getElementById('menu').classList.add('descente');}
    if(positionSpeach>500){document.getElementById('img-resto').classList.add('descente');}
    if(positionAvis>550){document.getElementById('note-space').classList.add('descente');}
}


/*galerie*/
function galerieOver(){document.getElementById('poignet').classList.add('in-galerie');}
function galerieOut(){document.getElementById('poignet').classList.remove('in-galerie');}

function changeImgSlide(){
    document.getElementById('slide-img').src=event.target.src;
    document.getElementById('slide-img').alt=event.target.alt;
    document.getElementById('slide-title').textContent=event.target.alt;
}
/*fin slide*/

/*avis*/
/*notif*/
function veutSavoir(){
    let vS=document.getElementById('veutSavoir');
    let qaAvis=document.getElementById('qaAvis');
    let cx=qaAvis.offsetLeft+qaAvis.clientWidth-202;
    let cy=qaAvis.offsetTop+60;
    vS.style.top=cy+'px';
    vS.style.left=cx+'px';
    vS.classList.remove('visually-hidden');
}
function outVeutSavoir(){document.getElementById('veutSavoir').classList.add('visually-hidden');}