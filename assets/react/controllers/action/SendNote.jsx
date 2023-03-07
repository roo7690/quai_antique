import React,{useEffect} from "react";

export default function (props){

    useEffect(()=>{
        let notes=document.getElementById("input_note").getElementsByTagName('label');
        Array.from(notes).forEach((star)=>{
            star.style.cursor='pointer';
            star.addEventListener('click',()=>{
                Array.from(notes).forEach((star2)=>{star2.style.color="black";});
                for(let i=0;i<5;i++){
                    if(notes[i]===star){
                        for(let j=0;j<i+1;j++){
                            notes[j].style.color="#75E6DA";
                        }
                    }
                }
            });
        });
    });

    return (
        <React.Fragment>
            <div className="m-2" id="input_note">
                <div className="form-check form-check-inline">
                    <input className="form-check-input hidden" type="radio" name="note" id="Note1" value="1"/>
                    <label className="form-check-label" htmlFor="Note1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             fill="currentColor" className="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input hidden" type="radio" name="note" id="Note2" value="2"/>
                    <label className="form-check-label" htmlFor="Note2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             fill="currentColor" className="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input hidden" type="radio" name="note" id="Note3" value="3"/>
                    <label className="form-check-label" htmlFor="Note3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             fill="currentColor" className="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input hidden" type="radio" name="note" id="Note4" value="4"/>
                    <label className="form-check-label" htmlFor="Note4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             fill="currentColor" className="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input hidden" type="radio" name="note" id="Note5" value="5"/>
                    <label className="form-check-label" htmlFor="Note5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                             fill="currentColor" className="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </label>
                </div>
            </div>
            <div className="m-2">
                <label htmlFor="msg_user" className="form-label fs-5">Laisser nous un mot.</label>
                <textarea className="form-control" name="msg_user" rows="10" cols="50" id="msg_user">
                    {props.msg || ''}
                </textarea>
            </div>
            <div className="d-flex justify-content-end">
                <input type="submit" value="Envoyer" className="btn qabtn"/>
            </div>
        </React.Fragment>
    );
}