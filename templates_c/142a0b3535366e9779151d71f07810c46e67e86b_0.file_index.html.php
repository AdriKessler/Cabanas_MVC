<?php
/* Smarty version 5.4.2, created on 2025-11-05 16:02:29
  from 'file:index.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690b6705c401c4_91778930',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '142a0b3535366e9779151d71f07810c46e67e86b' => 
    array (
      0 => 'index.html',
      1 => 1762283182,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
))) {
function content_690b6705c401c4_91778930 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates';
$_smarty_tpl->renderSubTemplate("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<section>
  <h2>Bienvenida</h2>
    <p>Este sistema permite gestionar las cabañas, las personas registradas y las reservas realizadas.</p>
    <p>Usá el menú para acceder a cada módulo.</p>
    <!-- Menú desplegable -->
   <div class="menu-dd">
  <button id="menuToggle" aria-expanded="false" aria-controls="menuList">Menú ▾</button>
  <nav id="menuList" class="menu-dd__panel" hidden>
    <a class="menu-dd__item" href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=cabanas">Cabañas</a>
    <a class="menu-dd__item" href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=personas">Personas</a>
    <a class="menu-dd__item" href="<?php echo $_smarty_tpl->getValue('base_url');?>
?action=reservas">Reservas</a>
  </nav>
</div>


</section>

<?php $_smarty_tpl->renderSubTemplate("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
