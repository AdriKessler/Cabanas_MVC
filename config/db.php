<?php
/**
 * config/db.php
 * Crea una conexión PDO reutilizable a MySQL
 */

function db(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $host = '127.0.0.1';  // o 'localhost'
        $dbname = 'cabanas_db';
        $user = 'root';        // usuario por defecto en XAMPP
        $pass = '';            // contraseña vacía por defecto
        $dsn  = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("❌ Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    return $pdo;
}
