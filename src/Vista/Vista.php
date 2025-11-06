<?php
    require_once(SERVER_PATH."/librerias/smarty-5.4.2/libs/Smarty.class.php");

   class Vista {
    protected $smarty;

    public function __construct() {
        $this->smarty = new Smarty\Smarty();
        $this->smarty->setTemplateDir(SERVER_PATH . '/templates/');
        $this->smarty->setCompileDir(SERVER_PATH . '/templates_c/');

        // Pasar mensajes flash a Smarty
        if (isset($_SESSION['flash'])) {
            $this->smarty->assign('flash', $_SESSION['flash']);
            unset($_SESSION['flash']);
        }

        // Si hay usuario logueado
        if (!empty($_SESSION['user'])) {
            $this->smarty->assign('user', $_SESSION['user']);
        }

        $this->smarty->assign('base_url', BASE_URL);
    }
}
