<?php
/* Smarty version 5.4.2, created on 2025-11-07 00:17:49
  from 'file:cabanas/agregar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690d2c9d90aae5_43695992',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd762af7cd694ff2aa4ee50baf3ceead263603c95' => 
    array (
      0 => 'cabanas/agregar.tpl',
      1 => 1761768327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690d2c9d90aae5_43695992 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates\\cabanas';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div class="container">
    <h2>Agregar Nueva Cabaña</h2>

        <?php if ((null !== ($_smarty_tpl->getValue('mensaje_texto') ?? null))) {?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_smarty_tpl->getValue('mensaje_texto');?>

        </div>
    <?php }?>

        <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas&sub_action=agregar" method="POST">
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Cabaña:</label>
                        <input type="text" 
                   class="form-control" 
                   id="nombre" 
                   name="nombre" 
                   required
                   placeholder="Ej: Cabaña Familiar">
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Cabaña</button>
        
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas&sub_action=listar" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
