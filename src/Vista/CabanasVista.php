<?php
require_once SERVER_PATH . '/src/Vista/Vista.php';

class CabanasVista extends Vista{

    /* ---------------- Mensajes (para Smarty) ---------------- */
    // Estos métodos ahora asignan mensajes a Smarty, no solo devuelven 'return;'

    private function _asignarMensaje($tipo, $texto) {
        // Asume que la clase base Vista tiene acceso a Smarty y a BASE_URL
        $this->smarty->assign('mensaje_tipo', $tipo);
        $this->smarty->assign('mensaje_texto', $texto);
    }

    public function mensajeOk($texto = "Operación realizada correctamente.") {
        $this->_asignarMensaje('success', $texto);
    }

    public function mensajeError($texto = "Ocurrió un error. Verifique los datos.") {
        $this->_asignarMensaje('error', $texto);
    }

    public function mensajeIdInvalido() {
        $this->_asignarMensaje('error', 'ID de cabaña inválido.');
    }

    public function mensajeNoExiste($id = null) {
        $this->_asignarMensaje('warning', "La cabaña con ID {$id} no existe.");
    }
    
    // --- Métodos de Renderizado de Formularios y Listado ---

    public function listar($cabanas, $mensaje = null) {
    $out = [];

    foreach ($cabanas as $c) {
        if (is_array($c)) {
            // Desde PDO: arrays asociativos
            $id     = $c['id']     ?? null;
            $nombre = $c['nombre'] ?? null;
        } elseif (is_object($c)) {
            // Objetos (por si algún modelo todavía devuelve objetos)
            if (method_exists($c, 'getId')) {
                $id = $c->getId();
            } elseif (isset($c->id)) {
                $id = $c->id;
            } else {
                $id = null;
            }

            if (method_exists($c, 'getNombre')) {
                $nombre = $c->getNombre();
            } elseif (isset($c->nombre)) {
                $nombre = $c->nombre;
            } else {
                $nombre = null;
            }
        } else {
            // Tipo inesperado
            $id = $nombre = null;
        }

        $out[] = ['id' => $id, 'nombre' => $nombre];
    }

    $this->smarty->assign('cabanas', $out);
    if ($mensaje) { 
        $this->smarty->assign('mensaje', $mensaje);
    }
    $this->smarty->display('cabanas/listar.tpl');
}


    /**
     * Muestra la plantilla del formulario para agregar una cabaña (GET).
     * @param array $errores Array de errores si la validación en POST falló.
     */
    public function mostrarFormularioAgregar(array $errores = []) {
        $this->smarty->assign('errores', $errores);
        $this->smarty->assign('action_url', BASE_URL . '?action=cabanas&sub_action=agregar');
        $this->smarty->display('cabanas/agregar.tpl');
    }

    /**
     * Muestra la plantilla del formulario para modificar una cabaña (GET).
     * @param object|array $cabana Datos de la cabaña a editar.
     */
    public function mostrarFormularioModificar($cabana = null, array $errores = []) {
        $this->smarty->assign('cabana', $cabana);
        $this->smarty->assign('errores', $errores);
        // 👇 este era el problema
        $this->smarty->assign('action_url', BASE_URL . '?action=cabanas&sub_action=modificar');
        $this->smarty->display('cabanas/editar.tpl');
    }
    /**
     * Muestra la plantilla de confirmación para borrar (GET).
     * @param object|array $cabana Datos de la cabaña a borrar.
     */
    public function mostrarFormularioBorrar($cabana) {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
        }
        $this->smarty->assign('cabana', $cabana);
        $this->smarty->assign('csrf', $_SESSION['csrf']);
        // opcional:
        // $this->smarty->assign('action_url', BASE_URL . '?action=cabanas&sub_action=borrar');
        $this->smarty->display('cabanas/borrar.tpl');
    }
    
}