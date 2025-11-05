<?php

class Persona {
    public static int $ultimoId = 0;

    private int $id;
    private string $nombre;
    private string $DNI;

    public function __construct($nombre, $DNI) {
        self::$ultimoId++;
        $this->id     = self::$ultimoId;
        $this->nombre = $nombre;
        $this->DNI    = $DNI;
    }

    public function getId(){ 
        return $this->id; 
    }
    
    public function getNombre(){ 
        return $this->nombre; 
    }
    
    public function setNombre($n) { 
        $this->nombre = $n; 
        return $this; 
    }

    public function getDNI(){ 
        return $this->DNI; 
    }
    
    public function setDNI($d){ 
        $this->DNI = $d; 
        return $this; 
    }
}