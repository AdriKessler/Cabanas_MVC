{include file="header.html"}

<h2>Eliminar Cabaña</h2>

<p>¿Estás segura de que querés eliminar la cabaña <strong>{$cabana.nombre|escape}</strong>?</p>

<form method="post" action="{$smarty.const.BASE_URL}?action=cabanas&sub_action=borrar">
  <input type="hidden" name="csrf" value="{$csrf}">
  <input type="hidden" name="id"   value="{$cabana.id}">
  <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
  <a href="{$smarty.const.BASE_URL}?action=cabanas&sub_action=listar">Cancelar</a>
</form>

{include file="footer.html"}
