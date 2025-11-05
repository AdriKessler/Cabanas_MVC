<?php

class PersonasVista extends Vista
{
    /* ----------- Mensajes ----------- */
    public function mensaje($texto) {
        $this->smarty->assign('tipo', 'info');
        $this->smarty->assign('texto', $texto);
        $this->smarty->display('personas/mensaje.tpl');
    }

    public function mensajeOk($texto = "Operación realizada correctamente.") {
        $this->smarty->assign('tipo', 'ok');
        $this->smarty->assign('texto', $texto);
        $this->smarty->display('personas/mensaje.tpl');
    }

    public function mensajeError($texto = "Ocurrió un error.") {
        $this->smarty->assign('tipo', 'error');
        $this->smarty->assign('texto', $texto);
        $this->smarty->display('personas/mensaje.tpl');
    }

    public function mensajeIdInvalido() {
        $this->mensajeError('ID inválido.');
    }

    public function mensajeNoExiste($id = null) {
        $txt = 'La persona no existe.';
        if ($id !== null) {
            $txt = 'La persona #' . (int)$id . ' no existe.';
        }
        $this->mensajeError($txt);
    }

    /* ----------- Listar ----------- */
    public function listar($personas, $mensaje = null) {
        $out = array();

        foreach ($personas as $p) {
            $id = null;
            $nombre = null;
            $dni = null;

            // Si viene de DB (array asociativo)
            if (is_array($p)) {
                if (isset($p['id']))     { $id = $p['id']; }
                if (isset($p['nombre'])) { $nombre = $p['nombre']; }
                if (isset($p['dni']))    { $dni = $p['dni']; }
            } else {
                // Si viniera como objeto
                if (method_exists($p, 'getId'))     { $id = $p->getId(); }
                if (method_exists($p, 'getNombre')) { $nombre = $p->getNombre(); }
                if (method_exists($p, 'getDNI'))    { $dni = $p->getDNI(); }
                if ($id === null && isset($p->id))         { $id = $p->id; }
                if ($nombre === null && isset($p->nombre)) { $nombre = $p->nombre; }
                if ($dni === null && isset($p->dni))       { $dni = $p->dni; }
            }

            $out[] = array(
                'id'     => $id,
                'nombre' => $nombre,
                'dni'    => $dni
            );
        }

        $this->smarty->assign('personas', $out);
        if ($mensaje) {
            $this->smarty->assign('mensaje', $mensaje);
        }

        $this->smarty->display('personas/listar.tpl');
    }

    /* ----------- Agregar ----------- */
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = '';
            $dni = '';

            if (isset($_POST['nombre'])) { $nombre = trim((string)$_POST['nombre']); }
            if (isset($_POST['dni']))    { $dni    = trim((string)$_POST['dni']); }

            if ($nombre !== '') { $nombre = ucwords($nombre); }

            if ($nombre === '' || $dni === '') {
                $this->mensajeError('Completá nombre y DNI.');
                // Re-mostrar form con valores ingresados
                $this->mostrarFormularioAgregar($nombre, $dni);
                return null;
            }

            if (!ctype_digit($dni)) {
                $this->mensajeError('El DNI debe contener solo dígitos.');
                $this->mostrarFormularioAgregar($nombre, $dni);
                return null;
            }

            return array('nombre' => $nombre, 'dni' => $dni);
        }

        $this->mostrarFormularioAgregar();
        return null;
    }

    public function mostrarFormularioAgregar($nombre = '', $dni = '') {
        $this->smarty->assign('nombre', $nombre);
        $this->smarty->assign('dni', $dni);
        $this->smarty->display('personas/agregar.tpl');
    }

    /* ----------- Modificar ----------- */
    public function modificar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = 0;
            $nombre = '';
            $dni = '';

            if (isset($_POST['id']))     { $id = (int)$_POST['id']; }
            if (isset($_POST['nombre'])) { $nombre = trim((string)$_POST['nombre']); }
            if (isset($_POST['dni']))    { $dni    = trim((string)$_POST['dni']); }

            if ($id <= 0) {
                $this->mensajeIdInvalido();
                return null;
            }

            if ($nombre !== '') { $nombre = ucwords($nombre); } else { $nombre = null; }

            if ($dni !== '') {
                if (!ctype_digit($dni)) {
                    $this->mensajeError('El DNI debe contener solo dígitos.');
                    $this->mostrarFormularioEditar(array('id'=>$id,'nombre'=>$nombre,'dni'=>$dni));
                    return null;
                }
            } else {
                $dni = null;
            }

            return array('id' => $id, 'nombre' => $nombre, 'dni' => $dni);
        }

        $this->mostrarFormularioEditar();
        return null;
    }

    public function mostrarFormularioEditar($persona = null) {
        // $persona puede ser array ['id','nombre','dni'] que pasa el controlador
        if ($persona !== null && is_array($persona)) {
            if (isset($persona['id']))     { $this->smarty->assign('id', $persona['id']); }
            if (isset($persona['nombre'])) { $this->smarty->assign('nombre', $persona['nombre']); }
            if (isset($persona['dni']))    { $this->smarty->assign('dni', $persona['dni']); }
        }
        $this->smarty->display('personas/editar.tpl');
    }

    /* ----------- Borrar ----------- */
    public function borrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = 0;
            if (isset($_POST['id'])) { $id = (int)$_POST['id']; }
            return array('id' => $id);
        }

        $this->mostrarFormularioBorrar();
        return null;
    }

    public function mostrarFormularioBorrar($persona = null) {
        // $persona puede ser array con ['id','nombre','dni'] para confirmar
        if ($persona !== null && is_array($persona)) {
            $this->smarty->assign('id', $persona['id']);
            $this->smarty->assign('nombre', $persona['nombre']);
            $this->smarty->assign('dni', $persona['dni']);
        }
        $this->smarty->display('personas/borrar.tpl');
    }

    public function opcionNoReconocida($nombre, $funcion) { return; }
}
