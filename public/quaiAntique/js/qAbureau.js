window.addEventListener('load',()=> {

    //Admin
    let Admins=document.getElementsByClassName('formAdmin');
    Array.from(Admins).forEach((Admin)=>{
        let submit=Array.from(Admin.getElementsByClassName('btn'))[0];
        let action=Array.from(Admin.getElementsByClassName('form-check-input'));
        let val=new Array(4),i=0;
        action.forEach((acte)=>{val[i]=acte.checked;i++;});
        action.forEach((acte)=>{
            acte.addEventListener('change',()=>{
                let newVal=new Array(4),j=0;
                action.forEach((act)=>{
                    newVal[j]=act.checked;
                    j++;
                });
                if(val[0]===newVal[0]&&val[1]===newVal[1]&&val[2]===newVal[2]&&val[3]===newVal[3]){
                    submit.disabled=true;
                }else{
                    submit.disabled=false;
                }
            });
        });
        action[3].addEventListener('change',()=>{
            if(action[3].checked){
                for(let d=0;d<3;d++){
                    action[d].checked=false;
                    action[d].disabled=true;
                }
            }else{
                for(let d=0;d<3;d++){
                    action[d].disabled=false;
                }
            }
        });
    });

    if(localStorage.getItem('echec')){
        document.getElementById('btnNotif').click();
        localStorage.removeItem('echec');
    }
});