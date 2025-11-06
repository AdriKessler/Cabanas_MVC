<?php
require_once __DIR__ . '/../config/db.php';

if (!class_exists('Conexion')) {
    class Conexion {
        public static function pdo(): PDO {
            return db();
        }
    }
}
class DB {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = db(); // usa la función de conexión
    }

    /* ---------- PERSONAS ---------- */
    public function agregarPersona($persona) {
        $sql = "INSERT INTO personas (nombre, dni) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$persona->getNombre(), $persona->getDni()]);
    }

    public function getPersonas() {
        $sql = "SELECT id, nombre, dni FROM personas ORDER BY nombre";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPersonaPorNombre($nombre) {
        $sql = "SELECT id, nombre, dni FROM personas WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPersonaPorDni($dni) {
        $sql = "SELECT id, nombre, dni FROM personas WHERE dni = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$dni]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPersonaPorId(int $id) {
        $st = Conexion::pdo()->prepare(
            'SELECT id, nombre, dni FROM personas WHERE id = :id'
        );
        $st->execute([':id' => $id]);
        $fila = $st->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            return $fila;
        } else {
            return false;
        }
    }

    public function personasParaSelect(): array {
            $sql = "SELECT id, nombre FROM personas ORDER BY nombre";
            $stmt = Conexion::pdo()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------- CABAÑAS ---------- */
    public function agregarCabaña($cabaña) {
        $sql = "INSERT INTO cabanas (nombre) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cabaña->getNombre()]);
    }

    public function getCabañas() {
        $sql = "SELECT id, nombre FROM cabanas ORDER BY id ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarCabañaPorNombre($nombre) {
        $sql = "SELECT id, nombre FROM cabanas WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Buscar cabaña por ID
    public function buscarCabañaPorId(int $id) {
        $sql = "SELECT id, nombre FROM cabanas WHERE id = ?";
        $st  = $this->pdo->prepare($sql);
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Actualizar cabaña
    public function actualizarCabaña(int $id, string $nombre): bool {
        $sql = "UPDATE cabanas SET nombre = ? WHERE id = ?";
        $st  = $this->pdo->prepare($sql);
        $st->execute([ucwords(trim($nombre)), $id]);
        return true;
    }

    // Borrar cabaña
    public function deleteById(int $id): bool {
        $st = Conexion::pdo()->prepare("DELETE FROM cabanas WHERE id = :id");
        $st->execute([':id' => $id]);
        return $st->rowCount() > 0; // true solo si borró alguna fila
    }

    public function cabanasParaSelect(): array {
        $sql = "SELECT id, nombre FROM cabanas ORDER BY nombre";
        $stmt = Conexion::pdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------- RESERVAS ---------- */
    public function agregarReserva(Reserva $r): bool {
        $st = Conexion::pdo()->prepare(
            'INSERT INTO reservas (persona_id, cabana_id, fecha_inicio, fecha_fin)
            VALUES (:persona, :cabana, :ini, :fin)'
        );
        return $st->execute([
            ':persona' => $r->getIdPersona(),
            ':cabana'  => $r->getIdCabaña(),
            ':ini'     => $r->getFechaEntrada(),
            ':fin'     => $r->getFechaSalida(),
        ]);
    }

    public function getReservas() {
        $sql = "SELECT r.id, p.nombre AS persona, c.nombre AS cabana, r.fecha_inicio, r.fecha_fin
                FROM reservas r
                JOIN personas p ON p.id = r.persona_id
                JOIN cabanas  c ON c.id = r.cabana_id
                ORDER BY r.fecha_inicio DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
        // Buscar una reserva por su ID
    public function buscarReservaPorId(int $id) {
        $st = Conexion::pdo()->prepare(
            'SELECT r.id,
                    r.persona_id,
                    r.cabana_id,
                    r.fecha_inicio,
                    r.fecha_fin,
                    p.nombre AS persona_nombre,
                    c.nombre AS cabana_nombre
            FROM reservas r
            JOIN personas p ON p.id = r.persona_id
            JOIN cabanas  c ON c.id = r.cabana_id
            WHERE r.id = :id'
        );
        $st->execute([':id' => $id]);
        $fila = $st->fetch(PDO::FETCH_ASSOC);
        return $fila ?: false;
    }

    // Actualizar una reserva existente
    public function actualizarReserva(
        int $id, int $idPersona, int $idCabana, string $entrada, string $salida): bool {
        $st = Conexion::pdo()->prepare(
            'UPDATE reservas
                SET persona_id   = :persona,
                    cabana_id    = :cabana,
                    fecha_inicio = :ini,
                    fecha_fin    = :fin
            WHERE id = :id'
        );
        return $st->execute([
            ':persona' => $idPersona,
            ':cabana'  => $idCabana,
            ':ini'     => $entrada,
            ':fin'     => $salida,
            ':id'      => $id,
        ]);
    }

    public function borrarReservaPorId(int $id): bool {
        $st = Conexion::pdo()->prepare('DELETE FROM reservas WHERE id = :id');
        return $st->execute([':id' => $id]);
    }

    public function getReservasConNombres(): array {
        $st = Conexion::pdo()->prepare(
            'SELECT r.id,
                    r.persona_id,
                    r.cabana_id,
                    p.nombre AS persona,
                    c.nombre AS cabana,
                    r.fecha_inicio AS entrada,
                    r.fecha_fin    AS salida
            FROM reservas r
            JOIN personas p ON p.id = r.persona_id
            JOIN cabanas  c ON c.id = r.cabana_id
            ORDER BY r.id ASC'
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function haySolapamientoReserva(int $cabanaId, string $entrada, string $salida, int $excluirId = 0): bool {
        $sql = "SELECT 1
                FROM reservas
                WHERE cabana_id = :cabana_id
                AND NOT (fecha_fin < :entrada OR fecha_inicio > :salida)";

        if ($excluirId > 0) {
            $sql .= " AND id <> :excluirId";
        }
        $sql .= " LIMIT 1";

        $st = Conexion::pdo()->prepare($sql);
        $params = [
            ':cabana_id' => $cabanaId,
            ':entrada'   => $entrada,
            ':salida'    => $salida,
        ];
        if ($excluirId > 0) {
            $params[':excluirId'] = $excluirId;
        }

        $st->execute($params);
        return (bool) $st->fetchColumn(); // true si hay al menos una superpuesta
    }
}
