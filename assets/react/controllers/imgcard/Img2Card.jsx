import React, {useEffect} from 'react';

export default function (){

    let style={
        zIndex:0,
        position: 'absolute',
        top:'200vh',
        left:'0',
        transform:'translateY(-70%)'
    };

    useEffect(()=>{
        let canvas2=document.getElementById('canvas2carte').getContext("2d");
        let img2=new Image();
        img2.src=document.getElementById('imgCanvas2').src;
        canvas2.drawImage(img2,0,0,700,900,0,0,700,900);
        let path2= new Path2D("M0 900V802.923C18.1578 916.91 78.6536 837.694 81.8952 852.401C85.1368 867.108 139.157 907.671 191.953 884.969C230.992 879.433 263.169 821.319 290.895 852.401C368.292 939.167 450.987 856.475 505.082 852.401C619.643 843.772 597 806.411 643.303 752.192C700 685.804 682.954 459.081 682.954 459.081C682.954 459.081 745.209 95.1983 531.022 95.1983C494.213 95.1983 476.102 -28.1952 370.196 46.3643C350.03 60.561 290.895 -26.9311 164.902 25.6785C132.372 39.2619 92.1475 62.2129 65.9608 63.8831C30.9794 59.8747 7.41133 83.0898 0 95.1983V-1.52588e-05H700V900H0Z");
        canvas2.fillStyle="#D4F1F4";
        canvas2.fill(path2);

    });

    return (
        <React.Fragment>
            <canvas id="canvas2carte" style={style} width="700" height="900"></canvas>
            <img id="imgCanvas2" src="img/constant/spoon-2754133_1280.jpg" style={{display: "none"}}/>
        </React.Fragment>
    );
}