<?php
/* Smarty version 5.4.2, created on 2025-11-07 00:17:33
  from 'file:personas/listar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690d2c8d241865_30840120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7eaf5a4a5f3cc0680cf9db5ee9b33e6876afb56c' => 
    array (
      0 => 'personas/listar.tpl',
      1 => 1762208890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690d2c8d241865_30840120 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\personas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Listado de Personas</h2>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>DNI</th>

  </tr>
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('personas'), 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
  <tr>
    <td><?php echo $_smarty_tpl->getValue('p')['id'];?>
</td>
    <td><?php echo $_smarty_tpl->getValue('p')['nombre'];?>
</td>
    <td><?php echo $_smarty_tpl->getValue('p')['dni'];?>
</td>
    <td>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
personas/editar/<?php echo $_smarty_tpl->getValue('p')['id'];?>
">Editar</a> |
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
personas/borrar/<?php echo $_smarty_tpl->getValue('p')['id'];?>
">Borrar</a>
    </td>
  </tr>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</table>

<a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
personas/agregar">Agregar nueva persona</a>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
