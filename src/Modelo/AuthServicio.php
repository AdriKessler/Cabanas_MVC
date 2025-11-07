<?php
class AuthServicio {
    public static function login(array $userRow): void {
        $_SESSION['user'] = [
            'id'     => $userRow['id'],
            'nombre' => $userRow['nombre'],
            'rol'    => $userRow['rol'] ?? 'user',
        ];
    }

    public static function logout(): void {
        $_SESSION = [];
        if (session_status() === PHP_SESSION_ACTIVE) session_destroy();
    }

    public static function user(): ?array {
        return $_SESSION['user'] ?? null;
    }

    public static function setFlash(string $key, string $msg) {
        $_SESSION['flash'][$key] = $msg;
    }

    public static function takeFlashes(): array {
        $f = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $f;
    }

    public static function csrfToken(): string {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['csrf'];
    }

    public static function verificarCsrf(string $token) {
        if (empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $token)) {
            http_response_code(400);
            exit('CSRF inválido');
        }
    }
}
