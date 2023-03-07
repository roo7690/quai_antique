import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'55px',left:'0'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas1Dessert').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgDessert1').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M247.963 -1.10891e-07C169.447 14.5848 81.7595 27.4781 3.0003 7.62939e-05C1.97129 3.76409 0.971173 7.52731 0 11.2889L0 0L247.963 -1.10891e-07ZM453 0C453 4.83194e-05 453 9.66389e-05 453 0.000144958C526.745 66.2444 525.791 406.376 267.5 480C127.807 519.818 39.5406 457.766 0 348.253L0 500H500V0H453Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas1Dessert" style={style} width="500" height="500"></canvas>
            <img id="imgDessert1" src="img/constant/dessert-1786311_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
