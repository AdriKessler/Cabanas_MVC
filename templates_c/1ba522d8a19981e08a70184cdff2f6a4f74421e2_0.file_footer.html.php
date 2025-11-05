<?php
/* Smarty version 5.4.2, created on 2025-11-05 16:02:31
  from 'file:footer.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690b6707ea48f7_80301717',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ba522d8a19981e08a70184cdff2f6a4f74421e2' => 
    array (
      0 => 'footer.html',
      1 => 1762282869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690b6707ea48f7_80301717 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates';
?>  </main>
    <footer>
        <p>© <?php echo $_smarty_tpl->getValue('anio');?>
 Sistema de Gestión de Cabañas. Todos los derechos reservados.</p>
    </footer>

    <!-- Enlace al script -->
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('base_url');?>
js/script.js?v=<?php echo time();?>
"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
