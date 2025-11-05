<?php

class Reserva {
    public static int $ultimoId = 0;

    private int $id_reserva;
    private int $id_persona;
    private int $id_cabaña;
    private string $fecha_entrada;
    private string $fecha_salida;

    public function __construct($id_persona, $id_cabaña, $fecha_entrada, $fecha_salida) {
        self::$ultimoId++;
        $this->id_reserva    = self::$ultimoId;
        $this->id_persona    = $id_persona;
        $this->id_cabaña     = $id_cabaña;
        $this->fecha_entrada = $fecha_entrada;
        $this->fecha_salida  = $fecha_salida;
    }

    public function getIdReserva(){ 
        return $this->id_reserva; 
    }
    
    public function getIdPersona(){ 
        return $this->id_persona; 
    }
    
    public function getIdCabaña(){ 
        return $this->id_cabaña; 
    }
    
    public function getFechaEntrada() { 
        return $this->fecha_entrada; 
    }
    
    public function getFechaSalida(){ 
        return $this->fecha_salida; 
    }
    public function setIdPersona($id) { 
        $this->id_persona = $id; 
        return $this; 
    }

    public function setIdCabaña($id)  { 
        $this->id_cabaña  = $id; 
        return $this; 
    }

    public function setFechaEntrada($f) { 
        $this->fecha_entrada = $f; 
        return $this; 
    }

    public function setFechaSalida($f)  { 
        $this->fecha_salida  = $f; 
        return $this; 
    }
}
