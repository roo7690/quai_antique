import React from 'react';

export default function (){

    let block={
        zIndex:0,
        position: 'fixed',
        top:'0',
        left:'50%',
        width:'100vw',
        height:'100vh',
        transform: 'translate(-50%,0)',
        overflow:'hidden'
    };
    let img={
        width:'100vw',
        height: '100vh'
    };

    return (
        <div style={block}>
            <img src="img/constant/ship-4816694_1920.jpg" style={img} alt="imgDesign"/>
        </div>
    );
}