import React from 'react';

export default function (){


    return (
        <React.Fragment>
            <div id="bannière1" className="d-flex justify-content-center
                            block-chef-text text-center qatext p-5 bg-secondary">
                <p>
                    <h1 className="qatitle fs-1 pb-2">Les spécialités Antiques</h1>
                    Vous les connaissiez peut-être sous le nom de « composants sans état » (Stateless (Functional) Components
                    ou SFC, NdT). Comme nous avons maintenant la possibilité d’utiliser l’état local React dans ces composants,
                    nous préférerons le terme « fonctions composants ».
                    Les Hooks ne fonctionnent pas dans les classes. Mais vous pouvez les utiliser pour éviter d’écrire des classes.
                </p>
            </div>
            <div className="block-chef-img">
                <img src="img/constant/chef-4625935_1920.jpg" className="w-100 h-100" alt="chef" />
            </div>
        </React.Fragment>
    );
}