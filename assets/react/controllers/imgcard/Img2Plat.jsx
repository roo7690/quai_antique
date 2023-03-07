import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'100vh',left:'100%',
        transform: 'translate(-100%,-100%)'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas2Plat').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgPlat2').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M500 0H0V500H139.545C53.5749 436.444 -16.3871 349.945 31.5001 262C44.4384 238.238 55.8469 216.046 66.4045 195.509C132.342 67.2449 165.084 3.55216 330 25.4998C401.921 26.2877 457.973 37.2632 500 55.505V0Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas2Plat" style={style} width="500" height="500"></canvas>
            <img id="imgPlat2" src="img/constant/asparagus-2169305_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
