<?php

class Torneo{
    private $coleccionPartidos;
    private $premio_importe;

    public function __construct($premio_importe){
        $this->coleccionPartidos=[];
        $this->premio_importe = $premio_importe;
    }

    public function getPremioImporte(){
        return $this->premio_importe;
    }
    public function setPremiosImporte($premio_importe){
        $this->premio_importe = $premio_importe;
    }

    public function getPartidos(){
        return $this->coleccionPartidos;
    }
    public function setPartidos($coleccionPartidos){
        $this->coleccionPartidos = $coleccionPartidos;
    }

    public function mostrarPartidos(){
        $mostrar=" ";
        $partidos = $this->getPartidos();

        for($i=0; $i<count($partidos);$i++){
            $mostrar = $mostrar. $partidos[$i]. "\n";
        }
    }

    public function __toString()
    {
        return "Coleccion de Partidos: ". $this->mostrarPartidos(). "\n" . 
                "Premio: ". $this->getPremioImporte(). "\n";
    }

    /**
     * Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la  clase Torneo
     *  el cual recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un partido
     *  de futbol o basquetbol . El método debe crear y retornar la instancia de la clase Partido que corresponda y
     *  almacenarla en la colección de partidos del Torneo. Se debe chequear que los 2 equipos tengan la misma categoría
     *  e igual cantidad de jugadores, caso contrario no podrá ser registrado ese partido en el torneo. 
    */
    public function ingresarPartido($equipo1, $equipo2, $fecha, $tipoPartido ){
        if($equipo1->getObjCategoria() != $equipo2->getObjCategoria() || $equipo1->getCantJugadores() != $equipo2->getCantJugadores()){
            $partido = null; //No podra ser registrado
        }else{
            $checkId = count($this->getPartidos());
            $id = $checkId + 1;
            $cantGoles1 = 0;
            $cantGoles2 = 0;
            $partido = new Partido($id, $fecha, $equipo1,$cantGoles1, $equipo2, $cantGoles2 );
            $this->coleccionPartidos[] = $partido;
        }
        return $partido;
    }

    /**
     * Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata de un partido
     *  de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos los equipos ganadores 
     * ( equipo con mayor cantidad de goles). El método retorna una colección con los objetos de los equipos encontrados.
    */
    public function darGanadores($deporte) {
        $arrayGanadores = [];
        $partidos = $this->getPartidos();
        $numPartidos = count($partidos);

        for ($i = 0; $i < $numPartidos; $i++) {
            $partido = $partidos[$i];
            if ($partido instanceof $deporte) {
                $ganadoresPartido = $partido->darEquipoGanador();
                $arrayGanadores[] = $ganadoresPartido;
            }
        }
        return $arrayGanadores;
    }

    /**
     * Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo asociativo donde una
     *  de sus claves es ‘equipoGanador’  y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’
     *  que contiene el valor obtenido del coeficiente del Partido por el importe configurado para el torneo. 
     * (premioPartido = Coef_partido * ImportePremio)
    */
    public function calcularPremioPartido($partido){

        $importePartido = $this->getPremioImporte();
        $coeficientePartido = $partido->coeficientePartido();
        $premioPartido = $coeficientePartido * $importePartido;

        $ganadorPartido = [ "equipoGanador"=> $partido , "premioPartido"=>$premioPartido];
        return $ganadorPartido;
    }
    


}