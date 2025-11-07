<?php
/* Smarty version 5.4.2, created on 2025-11-07 18:28:44
  from 'file:footer.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_690e2c4ca8aaf3_68914192',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ba522d8a19981e08a70184cdff2f6a4f74421e2' => 
    array (
      0 => 'footer.html',
      1 => 1762536518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690e2c4ca8aaf3_68914192 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\cabanas_MVC\\templates';
?>    </main>

  <footer class="bg-success text-white text-center py-3 mt-4">
    <small>© <?php ob_start();
echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y");
$_prefixVariable1 = ob_get_clean();
echo (($tmp = $_smarty_tpl->getValue('anio') ?? null)===null||$tmp==='' ? $_prefixVariable1 ?? null : $tmp);?>
 Sistema de Cabañas</small>
  </footer>

  <!-- Bootstrap JS (bundle con Popper incluido) -->
  <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('base_url');?>
js/script.js?v=<?php echo time();?>
"><?php echo '</script'; ?>
>
</body>
</html>

 <?php }
}
