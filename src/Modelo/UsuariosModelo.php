<?php
class UsuariosModelo {
    private PDO $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    public function buscarPorNombre(string $nombre): ?array {
        $q = $this->db->prepare('SELECT * FROM usuarios WHERE nombre = :n');
        $q->execute([':n' => $nombre]);
        $row = $q->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function crear(string $nombre, string $pass): int {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $q = $this->db->prepare(
            'INSERT INTO usuarios (nombre, pass_hash) VALUES (:n, :h)'
        );
        $q->execute([':n'=>$nombre, ':h'=>$hash]);
        return (int)$this->db->lastInsertId();
    }
}
