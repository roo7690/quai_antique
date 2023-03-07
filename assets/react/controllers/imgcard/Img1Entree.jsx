import React, {useEffect} from 'react';

export default function (){

    let style={
        position: 'absolute',
        top:'55px',left:'0'
    };

    useEffect(()=>{
        let canvas=document.getElementById('canvas1Entree').getContext("2d");
        let img=new Image();
        img.src=document.getElementById('imgEntree1').src;
        canvas.drawImage(img,100,100,600,600,0,0,500,500);
        let path= new Path2D(
            "M0 481.664C9.00768 487.973 19.8353 491.718 31.3438 492.016C338.213 499.955 422.102 421.821 467.059 270.678C496.68 171.094 408.787 58.6535 247.187 0H500V500H0V481.664Z"
        );
        canvas.fillStyle="#D4F1F4";
        canvas.fill(path);

    });

    return (
        <React.Fragment>
            <canvas id="canvas1Entree" style={style} width="500" height="500"></canvas>
            <img id="imgEntree1" src="img/constant/spinach-791629_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}
