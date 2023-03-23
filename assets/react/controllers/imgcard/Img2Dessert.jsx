import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'100vh',left:'100%',
        transform: 'translate(-100%,-100%)'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas2Dessert').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgDessert2').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M500 0H0V500H148.668C137.119 492.922 126.023 485.064 115.459 476.465L99.8934 463.796C64.7599 435.199 38.5589 397.131 24.3939 354.102C8.54954 305.971 8.54955 254.029 24.3939 205.898C38.5589 162.869 64.7599 124.801 99.8933 96.2044L115.458 83.5351C152.631 53.2783 196.4 32.1912 243.229 21.9779L307.03 8.06314C331.595 2.70558 356.706 0.109364 381.839 0.798288C430.051 2.11985 467.704 4.49995 500 8.67843V0Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas2Dessert" style={style} width="500" height="500"></canvas>
            <img id="imgDessert2" src="img/constant/cake-1971552_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
