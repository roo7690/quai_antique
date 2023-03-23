import React, {useState} from "react";

export default function (props){

    return(
        <div className="btn qabtn m-1" style={{width:"70px"}} onClick={Select}>
            <input className="form-check-input hidden" type="radio" id={props.hour}
                   name="creneau" value={props.hour} required/>
            <label className="form-check-label" style={{cursor:"pointer"}} htmlFor={props.hour}>
                {props.hour}
            </label>
        </div>
    );
}

function Select(){
    let creneaux=document.getElementById('select_creneau').getElementsByClassName('qabtn');
    console.log('select');
    Array.from(creneaux).forEach((creneau)=>{
        creneau.addEventListener('click',()=>{
            Array.from(creneaux).forEach((cre)=>{
                cre.classList.remove('select');
            });
            creneau.classList.add('select');
        });
    });
}