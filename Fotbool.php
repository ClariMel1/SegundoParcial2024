<?php 

class Fotbool extends Partido{
    /**
     * Si se trata de un partido de fútbol, se deben gestionar el valor de 3 coeficientes que serán aplicados
     *  según la categoría del partido (coef_Menores,coef_juveniles,coef_Mayores) .  A continuación se presenta 
     * una tabla en la que se detalla los valores por defecto de cada  coeficiente aplicado a una categoría de 
     * un partido  fútbol: 
    */
    public function coeficientePartido()
    {
        $coeficientePartido = parent::coeficientePartido();

        $equipo = $this->getObjEquipo1();
        $categoria = $equipo->getObjCategoria();
        $categoria2 = $categoria->getDescripcion();

        if($categoria2 == "Mayores"){
            $coefCat = 0.13;
        }elseif($categoria2 == "Menores"){
            $coefCat = 0.19;
        }elseif($categoria2 == "juveniles"){
            $coefCat = 0.27;
        }else{
            $coefCat = null;
        }


    }

}