<?php
// Activar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<h1>Test de Diagnóstico</h1>";

// 1. Test de sesión
session_start();
echo "<p>✓ Sesión iniciada correctamente</p>";

// 2. Test de constantes
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']));

echo "<p>✓ BASE_URL: " . BASE_URL . "</p>";
echo "<p>✓ SERVER_PATH: " . SERVER_PATH . "</p>";

// 3. Test de Smarty
$smartyPath = SERVER_PATH . "/libs/smarty-5.4.2/libs/Smarty.class.php";
echo "<p>Buscando Smarty en: " . $smartyPath . "</p>";

if (file_exists($smartyPath)) {
    echo "<p>✓ Archivo Smarty.class.php encontrado</p>";
    require_once($smartyPath);
    
    // Verificar qué clases se cargaron
    echo "<p>Clases disponibles:</p><ul>";
    if (class_exists('Smarty')) echo "<li>✓ Smarty</li>";
    if (class_exists('Smarty\Smarty')) echo "<li>✓ Smarty\Smarty</li>";
    if (class_exists('SmartyBC')) echo "<li>✓ SmartyBC</li>";
    echo "</ul>";
    
    try {
        // Intentar con namespace
        if (class_exists('Smarty\Smarty')) {
            $smarty = new Smarty\Smarty();
            echo "<p>✓ Smarty instanciado con namespace (Smarty\Smarty)</p>";
        } elseif (class_exists('Smarty')) {
            $smarty = new Smarty();
            echo "<p>✓ Smarty instanciado sin namespace (Smarty)</p>";
        } else {
            echo "<p>✗ No se encontró ninguna clase Smarty</p>";
        }
    } catch (Exception $e) {
        echo "<p>✗ Error al instanciar Smarty: " . $e->getMessage() . "</p>";
    } catch (Error $e) {
        echo "<p>✗ Error fatal al instanciar Smarty: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>✗ Archivo Smarty.class.php NO encontrado</p>";
}

// 4. Test de directorios de templates
$templatesDir = SERVER_PATH . '/templates';
$templatesCDir = SERVER_PATH . '/templates_c';

echo "<p>Templates dir: " . $templatesDir . " - " . 
     (is_dir($templatesDir) ? "✓ Existe" : "✗ NO existe") . "</p>";
echo "<p>Templates_c dir: " . $templatesCDir . " - " . 
     (is_dir($templatesCDir) ? "✓ Existe" : "✗ NO existe") . 
     (is_writable($templatesCDir) ? " y es escribible" : " pero NO es escribible") . "</p>";

// 5. Test de controladores
$loginController = SERVER_PATH . "/src/Controller/LoginController.php";
echo "<p>LoginController: " . 
     (file_exists($loginController) ? "✓ Existe" : "✗ NO existe") . "</p>";

// 6. Test de View
$viewFile = SERVER_PATH . "/src/View/View.php";
echo "<p>View.php: " . 
     (file_exists($viewFile) ? "✓ Existe" : "✗ NO existe") . "</p>";

if (file_exists($viewFile)) {
    require_once($viewFile);
    try {
        $view = new View();
        echo "<p>✓ View instanciada correctamente</p>";
    } catch (Exception $e) {
        echo "<p>✗ Error al instanciar View: " . $e->getMessage() . "</p>";
    }
}

// 7. Test de LoginModel y LoginView
$loginModel = SERVER_PATH . "/src/Model/LoginModel.php";
$loginView = SERVER_PATH . "/src/View/LoginView.php";

echo "<p>LoginModel.php: " . 
     (file_exists($loginModel) ? "✓ Existe" : "✗ NO existe") . "</p>";
echo "<p>LoginView.php: " . 
     (file_exists($loginView) ? "✓ Existe" : "✗ NO existe") . "</p>";

echo "<h2>Tests completados</h2>";
?>
