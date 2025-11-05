<?php

require_once SERVER_PATH . '/DB/DB.php';
require_once SERVER_PATH . '/src/Modelo/cabanas.php';

class CabanasModelo {
    private DB $db;

    public function __construct() {
        $this->db = new DB();   // crea su propia conexión a la base
    }

    /**
     * Devuelve todas las cabañas.
     */
    public function all() {
        return $this->db->getCabañas();
    }

    /**
     * Crea una nueva cabaña y la agrega a la colección.
     */
    public function create(string $nombre): int {
        // Creamos la cabaña
        $cabaña = new Cabaña($nombre);

        // Llamamos a la base de datos
        $resultado = $this->db->agregarCabaña($cabaña);

        // Devolvemos un número claro según el resultado
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Modifica el nombre de una cabaña por su ID y persiste el cambio.
     */
    public function update(int $id, string $nombre): bool {
        return $this->db->actualizarCabaña($id, $nombre);
    }

    /**
     * Borra una cabaña por su ID.
     */
    public function delete(int $id): bool {
        return $this->db->deleteById($id);
    }
    /**
     * Busca una cabaña por su ID.
     */
    public function findById(int $id) {
        return $this->db->buscarCabañaPorId($id);   // <-- nombre correcto
    }

    /**
     * Busca una cabaña por su nombre.
     */
    public function findByNombre(string $nombre) {
        return $this->db->buscarCabañaPorNombre($nombre);
    }
}