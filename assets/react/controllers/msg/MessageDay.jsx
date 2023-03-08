import React, {useEffect, useState} from 'react';

export default function (){
    const [msg,setMsg]=useState(null);

    useEffect(()=>{
        fetch('../quaiAntique/data/msg.json').then((res)=>{res.json().then((message)=>{
            setMsg(message[0].text);
        })});
    });

    return (
        <React.Fragment>
            <div className="col-md m-2">
                <img id="img-resto" src="../img/msg/imgMsg.jpg"
                     className="h-100 w-100 bur" alt="resto en image"/>
            </div>
            <div className="col-md m-2 p-5 message">
                <div className="text-center qatitle p-1">Message du jour</div>
                <div className="text-center qatext p-4">
                    {msg}
                </div>
            </div>
        </React.Fragment>
    );
}