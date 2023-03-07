import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'55px',left:'0'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas1Plat').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgPlat1').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M0 395.895V500H500V0H369.829L409.356 38.5008L450.854 124.521L460.429 219.546L436.926 312.115L383.179 391.064L305.672 446.868L213.753 472.798L118.509 465.727L31.4272 426.506L0 395.895Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas1Plat" style={style} width="500" height="500"></canvas>
            <img id="imgPlat1" src="img/constant/food-712665_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
