<?php

require_once SERVER_PATH . '/DB/DB.php';
require_once SERVER_PATH . '/src/Modelo/cabanas.php';
require_once SERVER_PATH . '/src/Modelo/personas.php';
require_once SERVER_PATH . '/src/Modelo/reservas.php';

class ReservasModelo {
    private DB $db;

    public function __construct() {
        $this->db = new DB();
    }

    /**
     * Devuelve todas las reservas.
     */
    public function all() {
    return $this->db->getReservasConNombres();
}
    /**
     * Crea una reserva nueva y la persiste.
     * Devuelve 1 en éxito, 0 en error (mismo estilo que CabanasModelo::create).
     */
    public function create(int $idPersona, int $idCabana, string $entrada, string $salida): int {
        $reserva = new Reserva($idPersona, $idCabana, $entrada, $salida);
        $ok = $this->db->agregarReserva($reserva);

        if ($ok) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Actualiza una reserva existente.
     */
    public function update(int $id, int $idPersona, int $idCabana, string $entrada, string $salida): bool {
        return $this->db->actualizarReserva($id, $idPersona, $idCabana, $entrada, $salida);
    }

    /**
     * Elimina una reserva por ID.
     */
    public function delete(int $id): bool {
        return $this->db->borrarReservaPorId($id);
    }

    /**
     * Busca una reserva por ID.
     */
    public function findById(int $id) {
        return $this->db->buscarReservaPorId($id);
    }

    /**
     * Busca una persona por ID (delegado en DB).
     */
    public function findPersonaById(int $id) {
        return $this->db->buscarPersonaPorId($id);
    }

    public function findCabanaById(int $id) {
        return$this->db->buscarCabañaPorId($id);     // o buscarCabanaPorId()   
    }
    /**
     * Verifica solapamiento de reservas para una cabaña entre dos fechas.
     * $excluirId permite ignorar una reserva puntual (útil en modificar).
     */
    public function haySolapamiento(int $cabanaId, string $fechaInicio, string $fechaFin, int $excluirId = 0): bool {
        return $this->db->haySolapamientoReserva($cabanaId, $fechaInicio, $fechaFin, $excluirId);
    }

    /**
     * Listas para <select> en formularios (delegado en DB).
     */
    public function personasParaSelect(): array {
        return $this->db->personasParaSelect();
    }

    public function cabanasParaSelect(): array {
        return $this->db->cabanasParaSelect();
    }

    /**
     * Getters/Setters del handler DB (opcional, igual que en tu código).
     */
    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
        return $this;
    }
}
