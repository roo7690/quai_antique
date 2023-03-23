import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'100vh',left:'100%',
        transform: 'translate(-100%,-100%)'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas2Boisson').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgBoisson2').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M252.037 500C330.553 485.415 418.241 472.522 497 500C498.029 496.236 499.029 492.473 500 488.711L500 500L252.037 500ZM46.9999 500C46.9998 500 46.9998 500 46.9997 500C-26.7449 433.756 -25.7914 93.624 232.5 20.0001C372.193 -19.8183 460.459 42.2344 500 151.747L500 -1.10891e-07L0 -1.10891e-07L0 500H46.9999Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas2Boisson" style={style} width="500" height="500"></canvas>
            <img id="imgBoisson2" src="img/constant/red-wine-1004255_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
