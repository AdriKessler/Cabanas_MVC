<?php
/* Smarty version 5.4.2, created on 2025-11-06 14:14:45
  from 'file:reservas/agregar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690c9f4562f908_67768557',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9162ca3eb9e20bb6de1958f9d8975de5d2d24d52' => 
    array (
      0 => 'reservas/agregar.tpl',
      1 => 1762434869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690c9f4562f908_67768557 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\reservas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Nueva reserva</h2>

<form method="post" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=agregar">
  
  <label>Persona:</label>
  <select name="persona_id" required style="min-width:220px">
    <option value="">-- Elegir persona --</option>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('personas'), 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
      <option value="<?php echo $_smarty_tpl->getValue('p')['id'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('p')['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</option>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </select>

  <label>Cabaña:</label>
  <select name="cabana_id" required style="min-width:220px">
    <option value="">-- Elegir cabaña --</option>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cabanas'), 'c');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('c')->value) {
$foreach1DoElse = false;
?>
      <option value="<?php echo $_smarty_tpl->getValue('c')['id'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('c')['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</option>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </select>

  <label>Fecha de entrada:</label>
  <input type="date" name="fecha_inicio" required>

  <label>Fecha de salida:</label>
  <input type="date" name="fecha_fin" required>

  <button type="submit">Guardar</button>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=listar">Cancelar</a>
</form>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
