import React from 'react';

export default function (){

    return (
        <React.Fragment>
            <div className="block-env-left">
                <img src="img/constant/depositphotos_114841988-stock-photo-interior-of-a-luxury-cruise.jpg" className="w-100 h-100" alt="chef" />
            </div>
            <div id="bannière2" className="d-flex justify-content-center block-env-text text-center qatext p-5 bg-secondary">
                <p>
                    <h1 className="qatitle fs-1 pb-2">Quai d'embarcation, pour un voyage gustatif</h1>
                    Vous les connaissiez peut-être sous le nom de « composants sans état » (Stateless (Functional) Components
                    ou SFC, NdT). Comme nous avons maintenant la possibilité d’utiliser l’état local React dans ces composants,
                    nous préférerons le terme « fonctions composants ».
                    Les Hooks ne fonctionnent pas dans les classes. Mais vous pouvez les utiliser pour éviter d’écrire des classes.
                </p>
            </div>
            <div className="block-env-right">
                <img src="img/constant/depositphotos_114847362-stock-photo-interior-of-a-cruise-boat.jpg" className="w-100 h-100" alt="chef" />
            </div>
        </React.Fragment>
    );
}