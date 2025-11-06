<?php
/* Smarty version 5.4.2, created on 2025-11-06 20:07:21
  from 'file:reservas/borrar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690cf1e9a37593_18928307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7429c4d303c21752ecf12b74e7bc8f18ed99ed25' => 
    array (
      0 => 'reservas/borrar.tpl',
      1 => 1762456034,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690cf1e9a37593_18928307 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\reservas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Eliminar Reserva</h2>

<p>
  ¿Estás segura de que querés eliminar la reserva de 
  <strong><?php echo (($tmp = (($tmp = $_smarty_tpl->getValue('reserva')['persona_nombre'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('reserva')['persona'] ?? null : $tmp) ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('reserva')['persona_id'] ?? null : $tmp);?>
</strong> 
  en la cabaña <strong><?php echo (($tmp = (($tmp = $_smarty_tpl->getValue('reserva')['cabana_nombre'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('reserva')['cabana'] ?? null : $tmp) ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('reserva')['cabana_id'] ?? null : $tmp);?>
</strong>
  del <?php echo $_smarty_tpl->getValue('reserva')['fecha_inicio'];?>
 al <?php echo $_smarty_tpl->getValue('reserva')['fecha_fin'];?>
?
</p>

<form method="post" action="<?php echo (defined('BASE_URL') ? constant('BASE_URL') : null);?>
?action=reservas&sub_action=borrar">
  <input type="hidden" name="csrf" value="<?php echo $_smarty_tpl->getValue('csrf');?>
">
  <input type="hidden" name="id"   value="<?php echo $_smarty_tpl->getValue('reserva')['id'];?>
">
  <button type="submit" class="btn btn-sm btn-danger">Sí, eliminar</button>
  <a href="<?php echo (defined('BASE_URL') ? constant('BASE_URL') : null);?>
?action=reservas&sub_action=listar">Cancelar</a>
</form>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
