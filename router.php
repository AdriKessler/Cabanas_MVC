<?php

// 1. INICIAR LA SESIÓN - Debe ser LO PRIMERO
session_start(); // imprescindible para login

// URL base para usar en enlaces dentro de los .tpl
define('BASE_URL', '//' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/');

// Ruta absoluta del proyecto en el disco (para require_once)
define('SERVER_PATH', __DIR__);

try {
    $pdo = new PDO('mysql:host=localhost;dbname=cabanas_db;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// --------- requires (siempre con SERVER_PATH) ----------
require_once SERVER_PATH . '/src/Controlador/CabanasControlador.php';
require_once SERVER_PATH . '/src/Controlador/PersonasControlador.php';
require_once SERVER_PATH . '/src/Controlador/ReservasControlador.php';
require_once SERVER_PATH . '/src/Controlador/UsuariosControlador.php';

// Agregá Smarty solo acá si lo vas a usar para la home
require_once SERVER_PATH . '/Librerias/smarty-5.4.2/libs/Smarty.class.php';

function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: '.BASE_URL.'?action=usuarios&sub_action=login');
        exit;
    }
}

$accion = $_GET['action'] ?? '';
$sub    = $_GET['sub_action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// === Usuarios ===
if ($accion === 'usuarios') {
    $ctrl = new UsuariosControlador($pdo);

    if     ($sub === 'login'    && $method==='GET')  $ctrl->loginView();
    elseif ($sub === 'login'    && $method==='POST') $ctrl->loginPost();
    elseif ($sub === 'registro' && $method==='GET')  $ctrl->registroView();
    elseif ($sub === 'registro' && $method==='POST') $ctrl->registroPost();
    elseif ($sub === 'logout')                       $ctrl->logout();
    else { http_response_code(404); echo 'No encontrado'; }
    exit;
}

// Instancio controladores
$cabanasCtrl  = new CabanasControlador();
$personasCtrl = new PersonasControlador();
$reservasCtrl = new ReservasControlador();

// Tomo la acción de la URL (?action=...)
$destino = isset($_GET['action']) ? strtolower(trim($_GET['action'])) : '';

// Según la acción, redirijo al módulo
switch ($destino) {
    case 'cabanas':
        $cabanasCtrl->menu();
        break;

    case 'personas':
        $personasCtrl->menu();
        break;

    case 'reservas':
        $reservasCtrl->menu();
        break;

    default:
        // Render de la página principal con Smarty (no incluir archivo directo)
        $smarty = new Smarty\Smarty();
        $smarty->setTemplateDir(SERVER_PATH . '/templates/');
        $smarty->setCompileDir(SERVER_PATH . '/templates_c/');

         // Asegurar que exista templates_c (evita error de línea 43)
        if (!is_dir($smarty->getCompileDir())) {
            mkdir($smarty->getCompileDir(), 0777, true);
        }

        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('titulo', 'Inicio');
         // opcional pero útil: mostrar sesión y mensajes en el header
        if (!empty($_SESSION['user'])) $smarty->assign('user', $_SESSION['user']);
        if (!empty($_SESSION['flash']['error']))   { $smarty->assign('flash_error', $_SESSION['flash']['error']); }
        if (!empty($_SESSION['flash']['success'])) { $smarty->assign('flash_success', $_SESSION['flash']['success']); }
        unset($_SESSION['flash']); // consumir flashes

        $smarty->display('index.html');
        break;
}
