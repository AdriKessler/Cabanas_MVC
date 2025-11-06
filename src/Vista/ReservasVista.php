<?php
require_once SERVER_PATH . '/src/Vista/Vista.php';

class ReservasVista extends Vista {

    /* ---------------- Mensajes (para Smarty) ---------------- */

    private function _asignarMensaje($tipo, $texto) {
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
        $this->_asignarMensaje('error', 'ID de reserva inválido.');
    }

    public function mensajeNoExiste($id = null) {
        $texto = 'La reserva no existe.';
        if ($id !== null) {
            $texto = 'La reserva con ID ' . (int)$id . ' no existe.';
        }
        $this->_asignarMensaje('warning', $texto);
    }

    /* ---------------- Listado ---------------- */

    public function listar($reservas, $mensaje = null) {
        $out = array();

        foreach ($reservas as $r) {
            $id = null;
            $persona = null;
            $cabana = null;
            $entrada = null;
            $salida = null;

            if (is_array($r)) {
                if (array_key_exists('id', $r)) {
                    $id = $r['id'];
                }
                if (array_key_exists('persona', $r)) {
                    $persona = $r['persona'];
                }
                if (array_key_exists('cabana', $r)) {
                    $cabana = $r['cabana'];
                }
                if (array_key_exists('entrada', $r)) {
                    $entrada = $r['entrada'];
                }
                if (array_key_exists('salida', $r)) {
                    $salida = $r['salida'];
                }
            } elseif (is_object($r)) {
                if (method_exists($r, 'getId')) {
                    $id = $r->getId();
                } elseif (property_exists($r, 'id')) {
                    $id = $r->id;
                }

                if (method_exists($r, 'getPersona')) {
                    $persona = $r->getPersona();
                } elseif (property_exists($r, 'persona')) {
                    $persona = $r->persona;
                }

                if (method_exists($r, 'getCabana')) {
                    $cabana = $r->getCabana();
                } elseif (property_exists($r, 'cabana')) {
                    $cabana = $r->cabana;
                }

                if (method_exists($r, 'getEntrada')) {
                    $entrada = $r->getEntrada();
                } elseif (property_exists($r, 'entrada')) {
                    $entrada = $r->entrada;
                }

                if (method_exists($r, 'getSalida')) {
                    $salida = $r->getSalida();
                } elseif (property_exists($r, 'salida')) {
                    $salida = $r->salida;
                }
            }

            $out[] = array(
                'id'      => $id,
                'persona' => $persona,
                'cabana'  => $cabana,
                'entrada' => $entrada,
                'salida'  => $salida
            );
        }

        $this->smarty->assign('reservas', $out);
        if ($mensaje) {
            $this->smarty->assign('mensaje', $mensaje);
        }
        $this->smarty->display('reservas/listar.tpl');
    }

    /* ---------------- Formularios ---------------- */

    public function mostrarFormularioAgregar(array $personas, array $cabanas, array $errores = array()) {
        $this->smarty->assign('personas', $personas);
        $this->smarty->assign('cabanas', $cabanas);
        $this->smarty->assign('errores', $errores);
        // URL limpia, sin signos de pregunta
        $this->smarty->assign('action_url', BASE_URL . '?action=reservas&sub_action=agregar');
        $this->smarty->display('reservas/agregar.tpl');
    }

    public function mostrarFormularioModificar($reserva, array $personas, array $cabanas, array $errores = array()) {
        $id = null;

        if (is_array($reserva)) {
            if (array_key_exists('id', $reserva)) {
                $id = (int)$reserva['id'];
            } elseif (array_key_exists('id_reserva', $reserva)) {
                $id = (int)$reserva['id_reserva'];
            }
        } elseif (is_object($reserva)) {
            if (method_exists($reserva, 'getId')) {
                $id = (int)$reserva->getId();
            } elseif (method_exists($reserva, 'getIdReserva')) {
                $id = (int)$reserva->getIdReserva();
            } elseif (property_exists($reserva, 'id')) {
                $id = (int)$reserva->id;
            }
        }

        $this->smarty->assign('reserva', $reserva);
        $this->smarty->assign('personas', $personas);
        $this->smarty->assign('cabanas', $cabanas);
        $this->smarty->assign('errores', $errores);

        // URL limpia con el ID al final
        if ($id !== null) {
            $this->smarty->assign('action_url', BASE_URL . '?action=reservas&sub_action=modificar&id=' . $id);
        } else {
           $this->smarty->assign('action_url', BASE_URL . '?action=reservas&sub_action=modificar');
        }

        $this->smarty->display('reservas/editar.tpl');
    }

    public function mostrarFormularioBorrar($reserva) {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
        }

        $this->smarty->assign('reserva', $reserva);
        $this->smarty->assign('csrf', $_SESSION['csrf']);
        $this->smarty->display('reservas/borrar.tpl');
    }

    /* ---------------- Opción no reconocida (mantengo firma) ---------------- */

    public function opcionNoReconocida($nombre, $funcion) {
        return;
    }
}
