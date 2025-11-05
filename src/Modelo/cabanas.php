<?php

class Cabaña {
    public static int $ultimoId = 0;

    private int $id;
    private string $nombre;

    public function __construct($nombre) {
        self::$ultimoId++;
        $this->id = self::$ultimoId;
        $this->nombre = $nombre;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }
}
