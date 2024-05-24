<?php

class Basket extends Partido{
    private $cantInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfracciones){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
        $this->coefPenalizacion = 0.75;
    }

    public function getCantInfracciones() {
        return $this->cantInfracciones;
    }

    public function setCantInfracciones($cantInfracciones) {
        $this->cantInfracciones = $cantInfracciones;
    }

    public function getCoefPenalizacion() {
        return $this->coefPenalizacion;
    }

    public function setCoefPenalizacion($coefPenalizacion) {
        $this->coefPenalizacion = $coefPenalizacion;
    }

    public function __toString()
    {
        $mostrar= parent::__toString();
        $mostrar = $mostrar . "Cantidad de Infracciones: ". $this->getCantInfracciones(). "\nCoeficiente de Penalizacion: ". $this->getCoefPenalizacion(). "\n";
        return $mostrar;
    }

    /**
     * Por otro lado, si se trata de un partido de basquetbol  se almacena la cantidad de infracciones de manera 
     * tal que al coeficiente base se debe restar un coeficiente de penalización, cuyo valor por defecto es: 
     * 0.75, * (por) la cantidad de infracciones. 
     * Es decir:coef  = coeficiente_base_partido  - (coef_penalización*cant_infracciones);
    */
    public function coeficientePartido()
    {
        $coeficienteFinal = parent::coeficientePartido();
        $infracciones = $this->getCantInfracciones();
        $coefBasket = $this->getCoefPenalizacion() * $infracciones;
        $coeficienteFinal = $coeficienteFinal - $coefBasket;
        return $coeficienteFinal;
    }

}