<?php
/* Smarty version 5.4.2, created on 2025-11-06 19:49:19
  from 'file:cabanas/borrar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690cedafea66d2_55514138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c218477c38584756ccac9d2ca5544f6da904dbd1' => 
    array (
      0 => 'cabanas/borrar.tpl',
      1 => 1762039055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690cedafea66d2_55514138 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\cabanas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Eliminar Cabaña</h2>

<p>¿Estás segura de que querés eliminar la cabaña <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('cabana')['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</strong>?</p>

<form method="post" action="<?php echo (defined('BASE_URL') ? constant('BASE_URL') : null);?>
?action=cabanas&sub_action=borrar">
  <input type="hidden" name="csrf" value="<?php echo $_smarty_tpl->getValue('csrf');?>
">
  <input type="hidden" name="id"   value="<?php echo $_smarty_tpl->getValue('cabana')['id'];?>
">
  <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
  <a href="<?php echo (defined('BASE_URL') ? constant('BASE_URL') : null);?>
?action=cabanas&sub_action=listar">Cancelar</a>
</form>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
