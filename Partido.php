<?php
class Partido{
    private $idpartido;
    private $fecha;
    private $objEquipo1;
    private $cantGolesE1;
    private $objEquipo2;
    private $cantGolesE2;
    private $coefBase;

    //CONSTRUCTOR
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
            $this->idpartido = $idpartido;
            $this->fecha = $fecha;
            $this->objEquipo1 =$objEquipo1;
            $this->cantGolesE1 = $cantGolesE1;
            $this->objEquipo2 = $objEquipo2;
            $this->cantGolesE2 = $cantGolesE2;
            $this->coefBase = 0.5;


    }

    //OBSERVADORES
    public function setidpartido($idpartido){
         $this->idpartido= $idpartido;
    }

    public function getIdpartido(){
        return $this->idpartido;
    }

    public function setFecha($fecha){
        $this->fecha= $fecha;
    }

    public function getFecha(){
        return $this->fecha;
    }


 public function setCantGolesE1($cantGolesE1){
        $this->cantGolesE1= $cantGolesE1;
    }

    public function getCantGolesE1(){
        return $this->cantGolesE1;
    }
 public function setCantGolesE2($cantGolesE2){
        $this->cantGolesE2= $cantGolesE2;
    }

    public function getCantGolesE2(){
        return $this->cantGolesE2;
    }



 public function setObjEquipo1($objEquipo1){
        $this->objEquipo1= $objEquipo1;
    }
    public function getObjEquipo1(){
        return $this->objEquipo1;
    }


 public function setObjEquipo2($objEquipo2){
        $this->objEquipo2= $objEquipo2;
    }
    public function getObjEquipo2(){
        return $this->objEquipo2;
    }




     public function setCoefBase($coefBase){
         $this->coefBase = $coefBase;
    }
      public function getCoefBase(){
        return $this->coefBase;
    }



public function __toString(){
        //string $cadena
        $cadena = "idpartido: ".$this->getIdpartido()."\n";
        $cadena = $cadena. "Fecha: ".$this->getFecha()."\n";
        $cadena = $cadena."\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "<Equipo 1> "."\n".$this->getObjEquipo1()."\n";
        $cadena = $cadena. "Cantidad Goles E1: ".$this->getCantGolesE1()."\n";
          $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
         $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "<Equipo 2> "."\n".$this->getObjEquipo2()."\n";
        $cadena = $cadena. "Cantidad Goles E2: ".$this->getCantGolesE2()."\n";
         $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        return $cadena;
    }

    /**
    * Implementar en la clase Partido el método darEquipoGanador() que retorna el equipo ganador de un partido
    *  (equipo con mayor cantidad de goles del partido), en caso de empate debe retornar a los dos equipos.
    */
    public function darEquipoGanador(){
        $golesEquipo1 = $this->getCantGolesE1();
        $golesEquipo2 = $this->getCantGolesE2();
        $equipo1 = $this->getObjEquipo1();
        $equipo2 = $this->getObjEquipo2();
        
        if($golesEquipo1 > $golesEquipo2){
            $equipoGanador = $this->getObjEquipo1();
        }elseif($golesEquipo2 > $golesEquipo1){
            $equipoGanador = $this->getObjEquipo2();
        }elseif($golesEquipo1 == $golesEquipo2){
            $equipoGanador = array_push($equipo1, $equipo2);
        }else{
            $equipoGanador = null;
        }
        return $equipoGanador;
    }

    /**
     * Implementar el método coeficientePartido() en la clase Partido el cual retorna el valor obtenido por 
     * el coeficiente base, multiplicado por la cantidad de goles y la cantidad de jugadores. Redefinir dicho 
     * método según corresponda.
     *  coef =  0,5 * cantGoles * cantJugadores 
    */
    public function coeficientePartido(){
        $goles1= $this->getCantGolesE1();
        $goles2= $this->getCantGolesE2();
        $sumaGoles = $goles1 + $goles2;

        $equipo1 = $this->getObjEquipo1();
        $jugadores1 = $equipo1->getCantJugadores();
        $equipo2= $this->getObjEquipo2();
        $jugadores2 = $equipo2->getCantJugadores();

        $sumaJugadores = $jugadores1 + $jugadores2;

        $coefBase = $this->getCoefBase();
        
        if($this instanceof Basket){
            $infracciones = $this->getCantInfracciones();
            $valor = $this->getCoefPenalizacion() * $infracciones;
            $coefBase= $coefBase - $valor;
        }elseif($this instanceof  Fotbool){
            $equipo = $this->getObjEquipo1();
            $categoria = $equipo->getObjCategoria();
            $categoria2 = $categoria->getDescripcion();
            if($categoria2 == "Mayores"){
                $coefBase = 0.13;
            }elseif($categoria2 == "Menores"){
                $coefBase = 0.19;
            }elseif($categoria2 == "juveniles"){
                $coefBase = 0.27;
            }else{
                $coefBase = null;
            }
        }

        $coeficienteFinal = $coefBase * $sumaGoles * $sumaJugadores;
        
        return $coeficienteFinal;
    }
}



?>