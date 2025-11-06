<?php
/* Smarty version 5.4.2, created on 2025-11-06 13:45:18
  from 'file:usuarios/login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690c985eb14d12_71706533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5b474dae214318b40a4885ff0367bf934a07d13' => 
    array (
      0 => 'usuarios/login.tpl',
      1 => 1762096399,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690c985eb14d12_71706533 (\Smarty\Template $_smarty_tpl) {
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
?action=usuarios&sub_action=login">
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
  <p><button type="submit">Entrar</button></p>
</form>

<p>¿No tenés cuenta? <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=registro">Registrate</a></p>
<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
