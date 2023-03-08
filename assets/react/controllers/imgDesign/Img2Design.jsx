import React, {useEffect, useState} from 'react';

export default function (){

    const [longeur,setLongeur]=useState('100vh'),plus=1600;

    let block={
        zIndex:0,
        position: 'fixed',
        top:'0',
        left:'50%',
        width:'100vw',
        height:longeur,
        transform: 'translate(-50%,0)',
        overflow:'hidden'
    };
    let img={
        width:'100vw',
        height: '100vh'
    };

    useEffect(()=>{
        window.addEventListener('scroll',()=>{
            let qaSpeach=document.getElementById('qaSpeach'),
                qaMenu=document.getElementById('menu');
            let height=((plus+qaSpeach.offsetHeight+qaMenu.offsetHeight+window.innerHeight-window.scrollY)+'px');
            setLongeur(height);
        });
    })

    return (
        <div style={block}>
            <img src="img/constant/the-needle-5462966_1920.jpg" style={img} alt="imgDesign"/>
        </div>
    );
}