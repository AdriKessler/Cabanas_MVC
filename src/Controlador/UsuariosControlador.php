<?php
require_once SERVER_PATH.'/src/Modelo/UsuariosModelo.php';
require_once SERVER_PATH.'/src/Modelo/AuthServicio.php';

class UsuariosControlador {
    private UsuariosModelo $modelo;

    public function __construct(PDO $pdo) {
        $this->modelo = new UsuariosModelo($pdo);
    }

    // ----- VISTAS -----
    public function loginView(): void {
        $smarty = $this->smarty();
        $smarty->assign('titulo', 'Iniciar sesión');
        $smarty->assign('csrf', AuthServicio::csrfToken());
        $smarty->display('usuarios/login.tpl');
    }

    public function registroView(): void {
        $smarty = $this->smarty();
        $smarty->assign('titulo', 'Crear cuenta');
        $smarty->assign('csrf', AuthServicio::csrfToken());
        $smarty->display('usuarios/registro.tpl');
    }

    // ----- ACCIONES -----
    public function loginPost(): void {
        AuthServicio::verificarCsrf($_POST['csrf'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $pass   = $_POST['password'] ?? '';

        $u = $this->modelo->buscarPorNombre($nombre);
        if (!$u || !password_verify($pass, $u['pass_hash'])) {
            AuthServicio::setFlash('error', 'Nombre o contraseña inválidos');
            header('Location: '.BASE_URL.'?action=usuarios&sub_action=login');
            exit;
        }

        AuthServicio::login($u);
        header('Location: '.BASE_URL);
        exit;
    }

    public function registroPost(): void {
        AuthServicio::verificarCsrf($_POST['csrf'] ?? '');
        $nombre = ucwords(trim($_POST['nombre'] ?? ''));
        $pass   = $_POST['password']  ?? '';
        $pass2  = $_POST['password2'] ?? '';

        if ($pass !== $pass2 || strlen($pass) < 6) {
            AuthServicio::setFlash('error', 'Las contraseñas deben coincidir y tener al menos 6 caracteres.');
            header('Location: '.BASE_URL.'?action=usuarios&sub_action=registro');
            exit;
        }
        if ($this->modelo->buscarPorNombre($nombre)) {
            AuthServicio::setFlash('error', 'Ese nombre ya está registrado.');
            header('Location: '.BASE_URL.'?action=usuarios&sub_action=registro');
            exit;
        }

        $id = $this->modelo->crear($nombre, $pass);
        $row = ['id'=>$id,'nombre'=>$nombre,'rol'=>'user'];
        AuthServicio::login($row);

        AuthServicio::setFlash('success','Cuenta creada con éxito');
        header('Location: '.BASE_URL);
        exit;
    }

    public function logout(): void {
        AuthServicio::logout();
        header('Location: '.BASE_URL);
        exit;
    }

    // ----- util -----
    private function smarty(): \Smarty\Smarty {
        $s = new \Smarty\Smarty();
        $s->setTemplateDir(SERVER_PATH.'/templates/');
        $s->setCompileDir(SERVER_PATH.'/templates_c/');
        $s->assign('base_url', BASE_URL);
        $s->assign('anio', date('Y'));

        if ($u = AuthServicio::user()) $s->assign('user', $u);
        $flashes = AuthServicio::takeFlashes();
        if (!empty($flashes['error']))   $s->assign('flash_error', $flashes['error']);
        if (!empty($flashes['success'])) $s->assign('flash_success', $flashes['success']);

        return $s;
    }
}
