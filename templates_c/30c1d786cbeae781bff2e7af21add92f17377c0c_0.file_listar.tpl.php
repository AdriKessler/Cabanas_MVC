<?php
/* Smarty version 5.4.2, created on 2025-11-06 13:45:34
  from 'file:cabanas/listar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690c986ed8a255_75953555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30c1d786cbeae781bff2e7af21add92f17377c0c' => 
    array (
      0 => 'cabanas/listar.tpl',
      1 => 1762040219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690c986ed8a255_75953555 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\cabanas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Listado de Cabañas</h2>

<table>
  <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cabanas'), 'c');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('c')->value) {
$foreach0DoElse = false;
?>
    <tr>
      <td><?php echo $_smarty_tpl->getValue('c')['id'];?>
</td>
      <td><?php echo $_smarty_tpl->getValue('c')['nombre'];?>
</td>
      <td>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas&sub_action=modificar&id=<?php echo $_smarty_tpl->getValue('c')['id'];?>
">Modificar</a> |
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas&sub_action=borrar&id=<?php echo $_smarty_tpl->getValue('c')['id'];?>
";">Borrar</a>
      </td>
    </tr>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</table>

<p><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas&sub_action=agregar">Agregar nueva cabaña</a></p>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
