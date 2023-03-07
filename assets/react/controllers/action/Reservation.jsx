import React,{useState,useEffect} from "react";
import Creneau from "./Creneau";

export default function (props){

    //date de réservation
    const [min,setMin]= useState(null),
        [max,setMax]= useState(null),
        [day,setDay]= useState(1),
        [creneaux,setCreneaux]=useState([]);
    //nbr de reservation possible pour un creneau
    const tables=2;

    useEffect(()=>{

        //Heure actuelle
        let hour=new Date();
        setInterval(()=>{
            hour= new Date();
            let hourmsg='Heure actuelle:  '+hour.getHours()+':'+hour.getMinutes();
            if(hour.getMinutes()<10){
                hourmsg='Heure actuelle:  '+hour.getHours()+':0'+hour.getMinutes();
            }
            document.getElementById('hour').textContent=hourmsg;
        },1000);

        //Date de réservation
        let hourmax=new Date(hour.getFullYear(),hour.getMonth(),hour.getDate()+14),
            date=document.getElementById('reservation_date');
        let monthMin=hour.getMonth()+1,monthMax=hourmax.getMonth()+1,dayMin=hour.getDate(),dayMax=hourmax.getDate();
        if(monthMin<10){monthMin='0'+monthMin;}if(dayMin<10){dayMin='0'+dayMin;}
        if(monthMax<10){monthMax='0'+monthMax;}if(dayMax<10){dayMax='0'+dayMax;}
        setMin(hour.getFullYear()+'-'+monthMin+'-'+dayMin);
        setMax(hourmax.getFullYear()+'-'+monthMax+'-'+dayMax);

        //récupérer les creneaux
        let dbCreneau= fetch('quaiAntique/data/creneaux.json');
        console.log(day);

        dbCreneau.then((response)=>{
            response.json().then((Creneaux)=>{
                let creneauxDay=[];
                Creneaux.forEach((cre)=>{
                    if(cre.WEEK===day&&cre.reserver<tables){
                        creneauxDay.push(cre);
                    }
                });
                setCreneaux(creneauxDay);
            })
        })
            .catch((err)=>{console.log('error : '+err);});

        document.getElementById('Reservation').addEventListener('submit',(ev)=>{
            ev.preventDefault();
            Reservation(day);
        });

    });

    return (
        <div className="container-fluid">
            <div className="row m-2 g-3 align-items-center">
                <div className="col-auto">
                    <label htmlFor="reservation_firstname">Nom</label>
                </div>
                <div className="col-auto">
                    <input id="reservation_firstname" name="reservation_firstname" type="text" className="form-control"
                           defaultValue={props.nom||''}/>
                </div>
            </div>
            <div className="row m-2 g-3 align-items-center">
                <div className="col-auto">
                    <label htmlFor="reservation_lastname">Prénom</label>
                </div>
                <div className="col-auto">
                    <input id="reservation_lastname" name="reservation_lastname" className="form-control" type="text"
                           defaultValue={props.prenom||''}/>
                </div>
            </div>
            <div className="row m-2 g-3 align-items-center">
                <div className="col-auto">
                    <label htmlFor="reservation_email">Email</label>
                </div>
                <div className="col-auto">
                    <input id="reservation_email" name="reservation_email" className="form-control" type="email"
                           defaultValue={props.email||''}/>
                </div>
            </div>
            <div className="row m-2 g-3 align-items-center">
                <div className="col-auto">
                    <label htmlFor="reservation_couvert">Nombre de couverts</label>
                </div>
                <div className="col-auto">
                    <input id="reservation_couvert" name="reservation_couvert" type="number" style={{width:"50px"}}
                           defaultValue={props.couvert||0}/>
                </div>
                <div className="col-auto">
                    <label htmlFor="reservation_enfant">Nombre d'enfants</label>
                </div>
                <div className="col-auto">
                    <input id="reservation_enfant" name="reservation_enfant" type="number" style={{width:"50px"}}
                           defaultValue={props.children || 0}/>
                </div>
            </div>
            <div className="row m-2 g-3 align-items-center" id="select_creneau">
                <div className="col-auto mb-4">
                    <label htmlFor="reservation_date">Sélectionner la date</label>
                </div>
                <div className="col-auto mb-4">
                    <input id="reservation_date" name="reservation_date" type="date" defaultValue={min} min={min} max={max}
                           onChange={()=>{let day=getDay(min);setDay(day);}}/>
                    <input type="number" className="hidden" name="jour" defaultValue={day}/>
                </div>
                <div className="container-fluid">
                    <div className="row justify-content-center">
                        {creneaux.map(cre=>(
                            <Creneau key={cre.horaire} hour={cre.horaire}/>
                        ))}
                    </div>
                </div>
            </div>
            <div className="row m-2 g-3 align-items-center">
                <label htmlFor="msg_user" className="form-label fs-5">Avez vous des allergies ou une demande particulière? (Mentionnez le ici).</label>
                <textarea className="form-control" name="msg_user" rows="10" cols="50" id="msg_user">
                    {props.msg || ''}
                </textarea>
            </div>
            <div className="d-flex justify-content-end">
                <input type="submit" value="Reserver" className="btn qabtn"/>
            </div>
        </div>
    );

}

function getDay(min){
    //récupérer la date
    let date;
    if(document.getElementById('reservation_date')!==null){
        date= document.getElementById('reservation_date').valueAsNumber - ((new Date(min)).getTime());
        date= (date/(3600000*24))-((date%(3600000*24))/(3600000*24))+1;
    }else{
        date=1;
    }
    return date;
}
function Reservation(day){
    let Hour;
    let hours=document.getElementById('Reservation').getElementsByClassName('hidden');
    Array.from(hours).forEach((hour)=>{
        if(hour.checked){
            Hour=hour.value;
        }
    })
    let info={
        name:document.getElementById('reservation_firstname').value+' '+document.getElementById('reservation_lastname').value,
        couvert:document.getElementById('reservation_couvert').value,
        enfant:document.getElementById('reservation_enfant').value,
        jour:day,
        date:document.getElementById('reservation_date').value,
        email:document.getElementById('reservation_email').value,
        hour:Hour
    };

    document.getElementById('reserver_name').value=info.name;
    document.getElementById('reserver_couvert').value=info.couvert;
    document.getElementById('reserver_enfant').value=info.enfant;
    document.getElementById('reserver_date').value=info.date;
    document.getElementById('reserver_hour').value=info.hour;
    document.getElementById('reserver_email').value=info.email;
    document.getElementById('reserver_jour').value=info.jour;

    document.getElementById('ReserverHidden').click();
}
