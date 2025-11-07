<?php

require_once SERVER_PATH . '/src/Modelo/CabanasModelo.php';
require_once SERVER_PATH . '/src/Vista/CabanasVista.php';

class CabanasControlador {
    private CabanasModelo $modelo;
    private CabanasVista $vista;

    public function __construct() {
        $this->modelo = new CabanasModelo();
        $this->vista  = new CabanasVista();
        require_login();
    }

    /**
     * Actúa como despachador de acciones web. 
     * Determina qué método ejecutar basándose en el parámetro 'sub_action' de la URL.
     */
    public function menu() {
        // Obtener la sub-acción. 'listar' es la acción por defecto si no se especifica.
        $sub_accion = isset($_GET['sub_action']) ? strtolower(trim($_GET['sub_action'])) : 'listar';
        
        // El bucle interactivo de consola se ELIMINA.
        
        switch ($sub_accion) {
            case 'listar':
                $this->listar();
                break;

            case 'agregar':
                // Se ejecuta agregar() tanto para mostrar el formulario como para procesar el POST.
                $this->agregar(); 
                break;

            case 'modificar':
                $this->modificar();
                break;

            case 'borrar':
                $this->borrar();
                break;
                
            default:
                // Si la acción no existe, redirigimos al listado.
                header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar');
                exit;
        }
    }

    public function listar() {
        $cabanas = $this->modelo->all();
        $this->vista->listar($cabanas); 
    }

    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = isset($_POST['nombre']) ? ucwords(trim((string) $_POST['nombre'])) : '';
            
            if ($nombre === '') {
                $this->vista->mensajeError("El nombre no puede estar vacío."); 
                // Vuelve a mostrar el formulario con un mensaje de error
                $this->vista->mostrarFormularioAgregar(); 
                return;
            }

            try {
                $this->modelo->create($nombre);
                // PRG: Redirige al listado con un mensaje de éxito
                header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar&msg=ok_add');
                exit; 
            } catch (\Throwable $e) {
                $this->vista->mensajeError("Ocurrió un error al guardar la cabaña.");
                $this->vista->mostrarFormularioAgregar(); // Vuelve a mostrar el formulario con el error
            }
        } else {
            // LÓGICA DE MOSTRAR FORMULARIO (GET)
            $this->vista->mostrarFormularioAgregar();
        }
    }

    public function modificar() {
        // ID por GET (mostrar) o POST (procesar)
        $id = isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;

        if ($id <= 0) {
            $this->vista->mensajeIdInvalido();
            header('Location: ' . BASE_URL . 'cabanas?sub_action=listar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar actualización
            $nombre = isset($_POST['nombre']) ? ucwords(trim((string) $_POST['nombre'])) : '';

            if ($nombre === '') {
                $this->vista->mensajeError("El nombre no puede estar vacío.");
                $cabana = $this->modelo->findById($id);
                $this->vista->mostrarFormularioModificar($cabana);
                return;
            }

            try {
                $ok = $this->modelo->update($id, $nombre);
                if ($ok) {
                    // PRG: volver al listado
                    header('Location: ' . BASE_URL . 'cabanas?sub_action=listar&msg=ok_mod');
                    exit;
                } else {
                    $this->vista->mensajeNoExiste($id);
                    $this->listar();
                    return;
                }
            } catch (\Throwable $e) {
                $this->vista->mensajeError("Error al intentar modificar la cabaña.");
                $cabana = $this->modelo->findById($id);
                $this->vista->mostrarFormularioModificar($cabana);
                return;
            }
        }

        // Mostrar formulario (GET)
        $cabana = $this->modelo->findById($id);
        if (!$cabana) {
            $this->vista->mensajeNoExiste($id);
            header('Location: ' . BASE_URL . 'cabanas?sub_action=listar');
            exit;
        }

        $this->vista->mostrarFormularioModificar($cabana);
    }
    
    public function borrar() {
        // --- Caso GET: mostrar confirmar borrado ---
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            if ($id <= 0) {
                $_SESSION['flash'] = 'ID inválido.';
                header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar'); exit;
            }

            $cabana = $this->modelo->findById($id);
            if (!$cabana) {
                $_SESSION['flash'] = 'La cabaña no existe.';
                header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar'); exit;
            }

            // Generar token CSRF
            if (empty($_SESSION['csrf'])) {
                $_SESSION['csrf'] = bin2hex(random_bytes(16));
            }

            $this->vista->mostrarFormularioBorrar($cabana);
            return; // 👈 importante: cortar acá para no seguir al bloque POST
        }

        // --- Caso POST: eliminar ---
        if (!isset($_POST['csrf']) || $_POST['csrf'] !== ($_SESSION['csrf'] ?? '')) {
            $_SESSION['flash'] = 'Token inválido.';
            header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar'); exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash'] = 'ID inválido.';
            header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar'); exit;
        }

        try {
            $ok = $this->modelo->delete($id);
            $_SESSION['flash'] = $ok ? 'Cabaña eliminada.' : 'La cabaña no existe o ya fue eliminada.';
        } catch (\PDOException $e) {
            if (($e->errorInfo[1] ?? null) === 1451) {
                $_SESSION['flash'] = 'No se puede eliminar: tiene reservas asociadas.';
            } else {
                $_SESSION['flash'] = 'Error al eliminar: ' . $e->getMessage();
            }
        }

        header('Location: ' . BASE_URL . '?action=cabanas&sub_action=listar'); exit;
    }
}