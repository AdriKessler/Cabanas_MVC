<?php
/* Smarty version 5.4.2, created on 2025-11-06 21:42:14
  from 'file:header.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690d08260687f5_42932207',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b485f79d25f1f4572dee3c24db9f1e2a263292de' => 
    array (
      0 => 'header.html',
      1 => 1762461439,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690d08260687f5_42932207 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates';
?><!-- Agrego el CSS al header -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('base_url');?>
css/style.css">

<nav>
  <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
">Inicio</a>
  <?php if ((null !== ($_smarty_tpl->getValue('user') ?? null))) {?>
    | Hola, <?php echo $_smarty_tpl->getValue('user')['nombre'];?>

    | <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=logout">Salir</a>
  <?php } else { ?>
    | <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=login">Entrar</a>
    | <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=usuarios&sub_action=registro">Registro</a>
  <?php }?>
</nav>

<hr>

<?php if ((null !== ($_smarty_tpl->getValue('flash') ?? null)) && $_smarty_tpl->getValue('flash') != '') {?>
  <div>
    <?php echo $_smarty_tpl->getValue('flash');?>

  </div>
<?php }
}
}
