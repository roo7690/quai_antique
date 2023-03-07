import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'100vh',left:'100%',
        transform: 'translate(-100%,-100%)'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas2Entree').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgEntree2').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M500 0H0V500H202.268L184.316 488.554C184.316 488.554 30.3504 515 19.5001 426.189C13.8887 380.259 26.356 359.854 39.7035 338.008C52.1648 317.612 65.3932 295.961 65.3933 251.111C65.3933 215.355 57.3979 189.234 50.6404 167.157C39.8434 131.883 32.2066 106.934 65.3932 69.4999C98.3482 32.3271 134.125 40.845 173.485 50.2158C198.569 56.1878 225.108 62.5061 253.298 57.5654C281.196 52.676 304.278 40.9736 326.111 29.9038C357.992 13.7403 387.212 -1.07457 424.882 8.63707C487.69 24.8292 487.858 62.9741 488.337 171.922L488.353 175.39C488.435 193.977 492.904 203.436 500 207.474V0Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas2Entree" style={style} width="500" height="500"></canvas>
            <img id="imgEntree2" src="img/constant/meal-2834549_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
