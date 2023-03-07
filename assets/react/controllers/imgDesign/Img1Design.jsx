import React,{useEffect,useState} from 'react';

export default function (){

    const [longeur,setLongeur]=useState('100vh'),plus=1200;

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
            let qaMenu=document.getElementById('menu');
            let height=((plus+qaMenu.offsetHeight+window.innerHeight-window.scrollY)+'px');
            setLongeur(height);
        });
    })

    return (
        <div style={block}>
            <img src="img/constant/dinner-829602_1920.jpg" style={img} alt="imgDesign"/>
        </div>
    );
}