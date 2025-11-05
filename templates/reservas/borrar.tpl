{include file="header.tpl"}

<h2>Eliminar Reserva</h2>

<p>
  ¿Estás segura de que querés eliminar la reserva de 
  <strong>{$reserva.persona}</strong> 
  en la cabaña <strong>{$reserva.cabana}</strong>
  del {$reserva.entrada} al {$reserva.salida}?
</p>

<form method="post" action="{$BASE_URL}?action=reservas&sub_action=borrar&id={$reserva.id}">
  <input type="hidden" name="csrf" value="{$csrf}">
  <button type="submit">Sí, eliminar</button>
  <a href="{$BASE_URL}?action=reservas&sub_action=listar">Cancelar</a>
</form>

{include file="footer.tpl"}
