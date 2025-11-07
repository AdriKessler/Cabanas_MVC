<?php
/* Smarty version 5.4.2, created on 2025-11-07 00:21:30
  from 'file:usuarios/registro.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690d2d7a9e01b8_29791340',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ca249e45fc0efc5ce8d67d17fa86c66fe0425ef' => 
    array (
      0 => 'usuarios/registro.tpl',
      1 => 1762096411,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690d2d7a9e01b8_29791340 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\usuarios';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
<h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>

<?php if ((null !== ($_smarty_tpl->getValue('flash_error') ?? null))) {?><p style="color:red"><?php echo $_smarty_tpl->getValue('flash_error');?>
</p><?php }
if ((null !== ($_smarty_tpl->getValue('flash_success') ?? null))) {?><p style="color:green"><?php echo $_smarty_tpl->getValue('flash_success');?>
</p><?php }?>

<form method="post" action="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=registro">
  <input type="hidden" name="csrf" value="<?php echo $_smarty_tpl->getValue('csrf');?>
">
  <p>
    <label>Nombre</label><br>
    <input type="text" name="nombre" required>
  </p>
  <p>
    <label>Contraseña</label><br>
    <input type="password" name="password" required>
  </p>
  <p>
    <label>Repetir contraseña</label><br>
    <input type="password" name="password2" required>
  </p>
  <p><button type="submit">Crear cuenta</button></p>
</form>

<p>¿Ya tenés cuenta? <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=login">Iniciá sesión</a></p>
<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
