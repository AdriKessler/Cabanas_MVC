<?php

require_once SERVER_PATH . '/src/Modelo/PersonasModelo.php';
require_once SERVER_PATH . '/src/Vista/PersonasVista.php';


class PersonasControlador {
    private PersonasModelo $modelo;
    private PersonasVista $vista;

    public function __construct() {
        $this->modelo = new PersonasModelo();
        $this->vista  = new PersonasVista();
        require_login();
    }

     public function menu() {
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
                header('Location: ' . BASE_URL . '?action=personas&sub_action=listar');
                exit;
        }
    }

    public function listar() {
        $personas = $this->modelo->all();
        $this->vista->listar($personas);
    }

    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = '';
        if (isset($_POST['nombre'])) {
            $nombre = trim((string) $_POST['nombre']);
            $nombre = ucwords($nombre);
        }

        $dni = '';
        if (isset($_POST['dni'])) {
            $dni = trim((string) $_POST['dni']);
            // opcional: quedate solo con dígitos
            $dni = preg_replace('/\D+/', '', $dni);
        }
        if ($nombre === '') {
            $this->vista->mensajeError("El nombre no puede estar vacío."); 
            // Vuelve a mostrar el formulario con un mensaje de error
            $this->vista->mostrarFormularioAgregar($nombre, $dni); 
            return;
        }

        if ($dni === '') {
            $this->vista->mensajeError("El nombre no puede estar vacío."); 
            // Vuelve a mostrar el formulario con un mensaje de error
            $this->vista->mostrarFormularioAgregar($nombre, $dni); 
            return;
        }

        try {
            $ok = $this->modelo->create($nombre, $dni); // que devuelva bool
            if ($ok === false) {
                $this->vista->mensajeError('No se pudo guardar la persona.');
                $this->vista->mostrarFormularioAgregar($nombre, $dni);
                return;
            }

            // PRG → volver al listado de PERSONAS
            header('Location: ' . BASE_URL . '?action=personas&sub_action=listar&msg=ok_add');
            exit;

        } catch (\PDOException $e) {
            // clave duplicada (dni UNIQUE)
            if (isset($e->errorInfo) && is_array($e->errorInfo) && isset($e->errorInfo[1])) {
                if ($e->errorInfo[1] == 1062) { // duplicate entry
                    $this->vista->mensajeError('Ese DNI ya está registrado.');
                    $this->vista->mostrarFormularioAgregar($nombre, $dni);
                    return;
                }
            }
            $this->vista->mensajeError('Ocurrió un error al guardar la persona.');
            $this->vista->mostrarFormularioAgregar($nombre, $dni);

        } catch (\Throwable $e) {
            $this->vista->mensajeError('Ocurrió un error al guardar la persona.');
            $this->vista->mostrarFormularioAgregar($nombre, $dni);
        }
        }else {
            // GET → mostrar formulario vacío
            $this->vista->mostrarFormularioAgregar();
        }
    }

    public function modificar() {
        $datos = $this->vista->modificar(); 

        $id     = $datos['id'];
        $nombre = $datos['nombre']; // null => mantener
        $dni    = $datos['dni'];    // null => mantener

        if ($id <= 0) {
            $this->vista->mensajeIdInvalido();
            return;
        }

        try {
            $ok = $this->modelo->updateById($id, $nombre, $dni);
            if ($ok) {
                $this->vista->mensajeOk();
            } else {
                $this->vista->mensajeNoExiste($id);
            }
        } catch (\Throwable $e) {
            $this->vista->mensajeError();
        }
    }
    
    public function borrar() {
        $datos = $this->vista->borrar();   
        $id = $datos['id'];

        if ($id <= 0) {
            $this->vista->mensajeIdInvalido();  
            return;
        }

        try {
            $ok = $this->modelo->deleteById($id);
            if ($ok) {
                $this->vista->mensajeOk();
            } else {
                $this->vista->mensajeNoExiste($id);
            }
        } catch (\Throwable $e) {
            $this->vista->mensajeError();
        }
    }
}
