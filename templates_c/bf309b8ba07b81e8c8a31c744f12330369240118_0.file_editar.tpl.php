<?php
/* Smarty version 5.4.2, created on 2025-11-07 00:55:39
  from 'file:cabanas/editar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690d357b2c5345_83326369',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf309b8ba07b81e8c8a31c744f12330369240118' => 
    array (
      0 => 'cabanas/editar.tpl',
      1 => 1761998421,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690d357b2c5345_83326369 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\cabanas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Editar cabaña</h2>
<form method="post" action="<?php echo (defined('BASE_URL') ? constant('BASE_URL') : null);?>
?action=cabanas&sub_action=modificar">
  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('cabana')['id'];?>
">
  
  <label for="nombre">Nombre</label>
  <input id="nombre" type="text" name="nombre" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('cabana_nombre'), ENT_QUOTES, 'UTF-8', true);?>
" required>
  
  <button type="submit">Actualizar</button>
</form>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
