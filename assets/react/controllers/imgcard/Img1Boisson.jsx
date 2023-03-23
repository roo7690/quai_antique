import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'55px',left:'0'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas1Boisson').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgBoisson1').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M0 500L500 500L500 0L360.455 0C446.425 63.5563 516.387 150.055 468.5 238C455.562 261.762 444.153 283.954 433.596 304.491C367.658 432.755 334.916 496.448 170 474.5C98.0787 473.712 42.0267 462.737 0 444.495V500Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas1Boisson" style={style} width="500" height="500"></canvas>
            <img id="imgBoisson1" src="img/constant/coffee-2139592_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
