<?php
require_once SERVER_PATH . '/DB/DB.php';
require_once SERVER_PATH . '/src/Modelo/personas.php';

class PersonasModelo {
    private DB $db;

    public function __construct() {
        // Asume que la instancia de DB está disponible globalmente
       $this->db = new DB(); 
    }
    
    public function all() {
        return $this->db->getPersonas();
    }

    /**
     * Crea una nueva persona.
     * Devuelve 1 si se insertó correctamente, o 0 si falló.
     */
    public function create(string $nombre, string $dni): int {
        // Crear el objeto Persona
        $persona = new Persona($nombre, $dni);

        // Insertar en la base de datos
        $resultado = $this->db->agregarPersona($persona);

        // Devolver resultado numérico
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function updateById($id, $nombre = null, $dni = null) {
        $p = $this->db->buscarPersonaPorNombreID($id);
        if (!$p) return false;

        if ($nombre !== null && $nombre !== '') 
            $p->setNombre(ucwords(trim($nombre)));
        if ($dni !== null && $dni !== '')       
            $p->setDNI(trim($dni));
        return true;
    }

    public function deleteById($id) {
        return $this->db->borrarPersonaPorID($id);
    }

    public function findById($id) {
        return $this->db->buscarPersonaPorNombreID($id);
    }

    public function findByNombre($nombre) {
        return $this->db->buscarPersonaPorNombre($nombre);
    }

}