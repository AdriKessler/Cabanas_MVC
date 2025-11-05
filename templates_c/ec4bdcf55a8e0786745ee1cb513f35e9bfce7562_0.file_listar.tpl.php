<?php
/* Smarty version 5.4.2, created on 2025-11-05 16:02:35
  from 'file:reservas/listar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690b670ba88752_13982161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec4bdcf55a8e0786745ee1cb513f35e9bfce7562' => 
    array (
      0 => 'reservas/listar.tpl',
      1 => 1762352048,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690b670ba88752_13982161 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\reservas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Listado de Reservas</h2>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Persona</th>
    <th>Cabaña</th>
    <th>Entrada</th>
    <th>Salida</th>
  </tr>
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reservas'), 'r');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('r')->value) {
$foreach0DoElse = false;
?>
  <tr>
    <td><?php echo $_smarty_tpl->getValue('r')['id'];?>
</td>
    <td><?php echo $_smarty_tpl->getValue('r')['persona'];?>
</td>
    <td><?php echo $_smarty_tpl->getValue('r')['cabana'];?>
</td>
    <td><?php echo $_smarty_tpl->getValue('r')['entrada'];?>
</td>
    <td><?php echo $_smarty_tpl->getValue('r')['salida'];?>
</td>
    <td>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=modificar&id=<?php echo $_smarty_tpl->getValue('r')['id'];?>
">Editar</a> |
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=borrar&id=<?php echo $_smarty_tpl->getValue('r')['id'];?>
">Borrar</a>
    </td>
  </tr>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</table>

<a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=agregar">Agregar nueva reserva</a>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
