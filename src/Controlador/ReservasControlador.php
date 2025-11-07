<?php
require_once SERVER_PATH . '/src/Modelo/ReservasModelo.php';
require_once SERVER_PATH . '/src/Vista/ReservasVista.php';


class ReservasControlador {
    private ReservasModelo $modelo;
    private ReservasVista $vista;

    public function __construct() {
        $this->modelo = new ReservasModelo();
        $this->vista  = new ReservasVista();
        require_login();
    }

    public function menu() {
            // usar en WEB; si vas a mantener CLI, dejá este método con otro nombre (p.ej. menuWeb)
        $sub = isset($_GET['sub_action']) ? strtolower(trim($_GET['sub_action'])) : 'listar';

        switch ($sub) {
            case 'listar':   
                $this->listar();   
                break;
            case 'agregar':  
                $this->agregar();  
                break;
            case 'modificar':
                $this->modificar();
                break;
            case 'borrar':   
                $this->borrar();   
                break;
            default:
                // podés mostrar plantilla de error o redirigir
                header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
                exit;
        }
    }

    public function listar() {
        $rows = array();
        $reservas = $this->modelo->all();

        foreach ($reservas as $r) {
            $id      = null;
            $persona = 'Desconocido';
            $cabana  = 'Desconocida';
            $entrada = '';
            $salida  = '';

            if (is_array($r)) {
                if (array_key_exists('id', $r))         { $id = (int)$r['id']; }
                if (array_key_exists('persona', $r))    { $persona = $r['persona']; }
                if (array_key_exists('cabana', $r))     { $cabana  = $r['cabana']; }
                if (array_key_exists('entrada', $r))    { $entrada = $r['entrada']; }
                if (array_key_exists('salida', $r))     { $salida  = $r['salida']; }
            }

            $rows[] = array(
                'id'      => $id,
                'persona' => $persona,
                'cabana'  => $cabana,
                'entrada' => $entrada,
                'salida'  => $salida
            );
        }

        $this->vista->listar($rows);
    }

    public function agregar() {
       if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $personas = $this->modelo->personasParaSelect();
            $cabanas  = $this->modelo->cabanasParaSelect();
            $this->vista->mostrarFormularioAgregar($personas, $cabanas);
            return;
        }

        // 2) Inicializar variables por defecto
        $idPersona = 0;
        $idCabana  = 0;
        $entrada   = '';
        $salida    = '';

        // 3) Cargar datos si existen
        if (isset($_POST['persona_id'])) {
            $idPersona = (int) $_POST['persona_id'];
        }
        if (isset($_POST['cabana_id'])) {
            $idCabana = (int) $_POST['cabana_id'];
        }
        if (isset($_POST['fecha_inicio'])) {
            $entrada = trim((string) $_POST['fecha_inicio']);
        }
        if (isset($_POST['fecha_fin'])) {
            $salida = trim((string) $_POST['fecha_fin']);
        }

        // 4) Validaciones básicas
        if ($idPersona <= 0) {
            $this->vista->mensajeError("Debe seleccionar una persona.");
            $this->recargarFormularioAgregar();
            return;
        }

        if ($idCabana <= 0) {
            $this->vista->mensajeError("Debe seleccionar una cabaña.");
            $this->recargarFormularioAgregar();
            return;
        }

        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $entrada)) {
            $this->vista->mensajeError("La fecha de entrada debe tener el formato YYYY-MM-DD.");
            $this->recargarFormularioAgregar();
            return;
        }

        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $salida)) {
            $this->vista->mensajeError("La fecha de salida debe tener el formato YYYY-MM-DD.");
            $this->recargarFormularioAgregar();
            return;
        }

        // 5) Validar fechas y orden
        try {
            $fechaEntrada = new DateTime($entrada);
            $fechaSalida = new DateTime($salida);
            if ($fechaSalida <= $fechaEntrada) {
                $this->vista->mensajeError("La fecha de salida debe ser posterior a la fecha de entrada.");
                $this->recargarFormularioAgregar();
                return;
            }
        } catch (Exception $e) {
            $this->vista->mensajeError("Las fechas ingresadas no son válidas.");
            $this->recargarFormularioAgregar();
            return;
        }

        // 6) Comprobar existencia de persona y cabaña
        $personaExiste = $this->modelo->findPersonaById($idPersona);
        if (!$personaExiste) {
            $this->vista->mensajeError("La persona seleccionada no existe.");
            $this->recargarFormularioAgregar();
            return;
        }

        $cabanaExiste = $this->modelo->findCabanaById($idCabana);
        if (!$cabanaExiste) {
            $this->vista->mensajeError("La cabaña seleccionada no existe.");
            $this->recargarFormularioAgregar();
            return;
        }

    // 7) Evitar solapamientos de reservas
       $solapado = $this->modelo->haySolapamiento($idCabana, $entrada, $salida, 0);
        if ($solapado) {
            $this->vista->mensajeError("Ya existe una reserva para esa cabaña en ese período.");
            $this->recargarFormularioAgregar();
            return;
        }

        try {
            $ok = $this->modelo->create($idPersona, $idCabana, $entrada, $salida);
            if ($ok) {
                $_SESSION['flash'] = 'Reserva creada correctamente.';
                header('Location: ' . BASE_URL . 'reservas/listar');
                exit;
            } else {
                $_SESSION['flash'] = 'No se pudo crear la reserva.';
                $this->recargarFormularioAgregar();
            }
        } catch (Throwable $e) {
           $_SESSION['flash'] = 'Error al crear: ' . $e->getMessage();
            $this->recargarFormularioAgregar();
        }
    }

    private function recargarFormularioAgregar() {
        $personas = $this->modelo->personasParaSelect();
        $cabanas = $this->modelo->cabanasParaSelect();
        $this->vista->mostrarFormularioAgregar($personas, $cabanas);
    }

    public function modificar() {
        $id = 0;
            if (isset($_GET['id'])) {
                $id = (int) $_GET['id'];
            }

            if ($id <= 0) {
                $this->vista->mensajeIdInvalido();
                header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $reserva = $this->modelo->findById($id);
                if (!$reserva) {
                    $this->vista->mensajeNoExiste($id);
                    header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
                    exit;
                }

                $personas = $this->modelo->personasParaSelect();
                $cabanas = $this->modelo->cabanasParaSelect();
                $this->vista->mostrarFormularioModificar($reserva, $personas, $cabanas);
                return;
            }

            $idPersona = 0;
            $idCabana = 0;
            $entrada = '';
            $salida = '';

            if (isset($_POST['persona_id'])) {
                $idPersona = (int) $_POST['persona_id'];
            }
            if (isset($_POST['cabana_id'])) {
                $idCabana = (int) $_POST['cabana_id'];
            }
            if (isset($_POST['fecha_inicio'])) {
                $entrada = trim((string) $_POST['fecha_inicio']);
            }
            if (isset($_POST['fecha_fin'])) {
                $salida = trim((string) $_POST['fecha_fin']);
            }

            $actual = $this->modelo->findById($id);
            if (!$actual) {
                $this->vista->mensajeNoExiste($id);
                 header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
                exit;
            }

            if ($entrada === '') {
                $entrada = $actual['fecha_inicio'];
            }
            if ($salida === '') {
                $salida = $actual['fecha_fin'];
            }
            if ($idPersona === 0) {
                $idPersona = $actual['persona_id'];
            }
            if ($idCabana === 0) {
                $idCabana = $actual['cabana_id'];
            }

            try {
                $fechaEntrada = new DateTime($entrada);
                $fechaSalida = new DateTime($salida);
                if ($fechaSalida <= $fechaEntrada) {
                    $this->vista->mensajeError("La fecha de salida debe ser posterior a la de entrada.");
                    $this->recargarFormularioModificar($actual);
                    return;
                }
            } catch (Exception $e) {
                $this->vista->mensajeError("Fechas inválidas.");
                $this->recargarFormularioModificar($actual);
                return;
            }

            $personaExiste = $this->modelo->findPersonaById($idPersona);
            if (!$personaExiste) {
                $this->vista->mensajeError("La persona seleccionada no existe.");
                $this->recargarFormularioModificar($actual);
                return;
            }

            $cabanaExiste = $this->modelo->findCabanaById($idCabana);
            if (!$cabanaExiste) {
                $this->vista->mensajeError("La cabaña seleccionada no existe.");
                $this->recargarFormularioModificar($actual);
                return;
            }

            $solapado = $this->modelo->haySolapamiento($idCabana, $entrada, $salida, $id);
            if ($solapado) {
                $this->vista->mensajeError("Ya existe una reserva para esa cabaña en ese período.");
                $this->recargarFormularioModificar($actual);
                return;
            }

            try {
                $ok = $this->modelo->update($id, $idPersona, $idCabana, $entrada, $salida);
                if ($ok) {
                    header('Location: ' . BASE_URL . 'reservas?sub_action=listar');
                    exit;
                } else {
                    $this->vista->mensajeNoExiste($id);
                    $this->recargarFormularioModificar($actual);
                }
            } catch (Throwable $e) {
                $this->vista->mensajeError("Error al actualizar la reserva.");
                $this->recargarFormularioModificar($actual);
            }
        }

        private function recargarFormularioModificar($reserva) {
            $personas = $this->modelo->personasParaSelect();
            $cabanas = $this->modelo->cabanasParaSelect();
            $this->vista->mostrarFormularioModificar($reserva, $personas, $cabanas);
        }

    public function borrar() {
    // --- Caso GET: mostrar confirmar borrado ---
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        if ($id <= 0) {
            $_SESSION['flash'] = 'ID inválido.';
            header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
            exit;
        }

        $reserva = $this->modelo->findById($id);
        if (!$reserva) {
            $_SESSION['flash'] = 'La reserva no existe.';
            header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
            exit;
        }

        // Generar token CSRF
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
        }

        $this->vista->mostrarFormularioBorrar($reserva);
        return; // 👈 cortar acá para no seguir al bloque POST
    }

    // --- Caso POST: eliminar ---
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== (isset($_SESSION['csrf']) ? $_SESSION['csrf'] : '')) {
        $_SESSION['flash'] = 'Token inválido.';
        header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
        exit;
    }

    $id = 0;
    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];
    }

    if ($id <= 0) {
        $_SESSION['flash'] = 'ID inválido.';
        header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
        exit;
    }

    try {
        $ok = $this->modelo->delete($id);
        $_SESSION['flash'] = $ok
            ? 'Reserva eliminada.'
            : 'La reserva no existe o ya fue eliminada.';
    } catch (\PDOException $e) {
        if (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1451) {
            $_SESSION['flash'] = 'No se puede eliminar: está asociada a otra entidad.';
        } else {
            $_SESSION['flash'] = 'Error al eliminar: ' . $e->getMessage();
        }
    }
    header('Location: ' . BASE_URL . '?action=reservas&sub_action=listar');
    exit;
}

}