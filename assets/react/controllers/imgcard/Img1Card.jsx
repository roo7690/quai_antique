import React, {useEffect} from 'react';

export default function (){

    let style={
        zIndex:0,
        position: 'absolute',
        top:'100vh',left:'100%',
        transform: 'translate(-100%,110px)'
    };

    useEffect(()=>{
        let canvas1=document.getElementById('canvas1carte').getContext("2d");
        let img1=new Image();
        img1.src=document.getElementById('imgCanvas1').src;
        canvas1.drawImage(img1,0,0,500,900,0,0,500,900);
        let path1= new Path2D("M98.5 122.5C-89.5 430.5 38 939.5 354.5 822L500 745V900H-9.15527e-05V0H181L98.5 122.5Z");
        canvas1.fillStyle="#D4F1F4";
        canvas1.fill(path1);

    });

    return (
        <React.Fragment>
            <canvas id="canvas1carte" style={style} width="500" height="900"></canvas>
            <img id="imgCanvas1" src="img/constant/food-1050813_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
);
}