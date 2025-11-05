{include file="header.html"}

<h2>Editar cabaña</h2>
<form method="post" action="{$smarty.const.BASE_URL}?action=cabanas&sub_action=modificar">
  <input type="hidden" name="id" value="{$cabana.id}">
  
  <label for="nombre">Nombre</label>
  <input id="nombre" type="text" name="nombre" value="{$cabana_nombre|escape:'html'}" required>
  
  <button type="submit">Actualizar</button>
</form>

{include file="footer.html"}
