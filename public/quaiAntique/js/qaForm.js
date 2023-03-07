/*Validation*/
window.addEventListener('load',()=>{

    let form=document.getElementsByTagName('form');
    form[0].addEventListener('submit',(ev)=>{
        let password=document.getElementById('inscrip_connexion_password'),
            email=document.getElementById('inscrip_connexion_email'),
            Email=email.value.match(/^[\w\.]+@([\w-]+\.)+[\w-]{2,4}$/),
            Password=password.value.match(/^.{8,}$/);

        if(!Email||!Password){
            ev.preventDefault();
        }
        if(Email){
            email.classList.remove('invalid');
            email.classList.add('valid');
        }else{
            email.classList.remove('valid');
            email.classList.add('invalid');
        }
        if(Password){
            password.classList.remove('invalid');
            password.classList.add('valid');
        }else{
            password.classList.remove('valid');
            password.classList.add('invalid');
        }
    });

});
function validation(){

}

/*Focus*/
function inlabel(){
    let champ=event.target.parentElement.parentElement;
    let champLabel=Array.from(champ.getElementsByTagName('label'));
    champLabel[0].classList.add('focus');
}
function offlabel(){
    if(event.target.value===''){
        let champ=event.target.parentElement.parentElement;
        let champLabel=Array.from(champ.getElementsByTagName('label'));
        champLabel[0].classList.remove('focus');
    }
}
function load_label(){
    if(event.target.value!==''){
        let champ=event.target.parentElement.parentElement;
        let champLabel=Array.from(champ.getElementsByTagName('label'));
        champLabel[0].classList.add('focus');
    }
}
/*changer le status de password*/
function ViewPassword(){
    /*change svg*/
    document.getElementById('pass-view').classList.add('hidden');
    document.getElementById('pass-view').classList.remove('d-inline-flex');
    document.getElementById('pass-notView').classList.add('d-inline-flex');
    document.getElementById('pass-notView').classList.remove('hidden');
    /*chg state pass*/
    document.getElementById('inscrip_connexion_password').type='text';
}
function NotViewPassword(){
    /*change svg*/
    document.getElementById('pass-view').classList.add('d-inline-flex');
    document.getElementById('pass-view').classList.remove('hidden');
    document.getElementById('pass-notView').classList.add('hidden');
    document.getElementById('pass-notView').classList.remove('d-inline-flex');
    /*chg state pass*/
    document.getElementById('inscrip_connexion_password').type='password';
}