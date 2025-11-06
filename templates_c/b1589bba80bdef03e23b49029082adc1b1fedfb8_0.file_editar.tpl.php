<?php
/* Smarty version 5.4.2, created on 2025-11-06 14:54:27
  from 'file:reservas/editar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690ca893d71cb2_26238471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1589bba80bdef03e23b49029082adc1b1fedfb8' => 
    array (
      0 => 'reservas/editar.tpl',
      1 => 1762437257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690ca893d71cb2_26238471 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\reservas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2>Editar Reserva</h2>

<form method="post" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=modificar&id=<?php echo $_smarty_tpl->getValue('reserva')['id'];?>
">
  <label for="persona_id">Persona:</label><br>
  <select id="persona_id" name="persona_id" required>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('personas'), 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
    <option value="<?php echo $_smarty_tpl->getValue('p')['id'];?>
" <?php if ($_smarty_tpl->getValue('p')['id'] == $_smarty_tpl->getValue('reserva')['persona_id']) {?>selected<?php }?>>
      <?php echo $_smarty_tpl->getValue('p')['nombre'];?>

      <?php if ((null !== ($_smarty_tpl->getValue('p')['dni'] ?? null))) {?> (DNI: <?php echo $_smarty_tpl->getValue('p')['dni'];?>
)<?php }?>
    </option>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </select><br><br>

  <label for="cabana_id">Cabaña:</label><br>
  <select id="cabana_id" name="cabana_id" required>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cabanas'), 'c');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('c')->value) {
$foreach1DoElse = false;
?>
      <option value="<?php echo $_smarty_tpl->getValue('c')['id'];?>
" <?php if ($_smarty_tpl->getValue('c')['id'] == $_smarty_tpl->getValue('reserva')['cabana_id']) {?>selected<?php }?>>
        <?php echo $_smarty_tpl->getValue('c')['nombre'];?>

      </option>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </select><br><br>

  <label for="fecha_inicio">Fecha de entrada:</label><br>
  <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $_smarty_tpl->getValue('reserva')['fecha_inicio'];?>
" required><br><br>

  <label for="fecha_fin">Fecha de salida:</label><br>
  <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $_smarty_tpl->getValue('reserva')['fecha_fin'];?>
" required><br><br>

  <button type="submit">Actualizar</button>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
?action=reservas&sub_action=listar">Cancelar</a>
</form>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
