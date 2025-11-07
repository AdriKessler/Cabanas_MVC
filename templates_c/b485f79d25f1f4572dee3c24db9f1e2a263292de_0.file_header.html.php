<?php
/* Smarty version 5.4.2, created on 2025-11-07 19:40:52
  from 'file:header.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690e3d34bdc216_11304906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b485f79d25f1f4572dee3c24db9f1e2a263292de' => 
    array (
      0 => 'header.html',
      1 => 1762540850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690e3d34bdc216_11304906 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo (($tmp = $_smarty_tpl->getValue('titulo') ?? null)===null||$tmp==='' ? "Sistema de Cabañas" ?? null : $tmp);?>
</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos propios -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('base_url');?>
css/style.css?v=2">

  <!-- Fondo global directo (opcional, para asegurar que se vea en todas las páginas) -->
</head>

<body>

  <!-- Navbar Bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menuNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="<?php echo $_smarty_tpl->getValue('base_url');?>
">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas">Cabañas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=personas">Personas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=reservas">Reservas</a></li>
        </ul>

        <!-- Sección derecha (login/usuario) -->
        <div class="d-flex align-items-center">
          <?php if ((null !== ($_smarty_tpl->getValue('user') ?? null))) {?>
            <span class="text-white me-2 small">👤 Hola, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('user')['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</span>
            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=logout" class="btn btn-outline-light btn-sm">Salir</a>
          <?php } else { ?>
            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=login" class="btn btn-outline-light btn-sm me-2">Entrar</a>
            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=registro" class="btn btn-light btn-sm">Registro</a>
          <?php }?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Línea separadora opcional -->
  <hr class="my-0">

  <!-- Contenido principal -->
  <main class="container mt-4">
    <?php if ((null !== ($_smarty_tpl->getValue('flash') ?? null)) && $_smarty_tpl->getValue('flash') != '') {?>
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('flash'), ENT_QUOTES, 'UTF-8', true);?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php }
}
}
