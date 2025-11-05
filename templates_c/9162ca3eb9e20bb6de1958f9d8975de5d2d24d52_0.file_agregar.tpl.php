<?php
/* Smarty version 5.4.2, created on 2025-11-05 16:02:20
  from 'file:reservas/agregar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690b66fc45f489_85971918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9162ca3eb9e20bb6de1958f9d8975de5d2d24d52' => 
    array (
      0 => 'reservas/agregar.tpl',
      1 => 1762352127,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_690b66fc45f489_85971918 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\reservas';
$_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Nueva reserva</h2>

<form method="post" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=agregar">
  <select name="persona_id" required>…</select>
  <select name="cabana_id"  required>…</select>
  <input type="date" name="fecha_inicio" required>
  <input type="date" name="fecha_fin"    required>
  <button type="submit">Guardar</button>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=listar">Cancelar</a>
</form>

<?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
