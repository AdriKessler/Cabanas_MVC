{include file="header.html"}

<h2>Eliminar Reserva</h2>

<p>
  ¿Estás segura de que querés eliminar la reserva de 
  <strong>{$reserva.persona_nombre|default:$reserva.persona|default:$reserva.persona_id}</strong> 
  en la cabaña <strong>{$reserva.cabana_nombre|default:$reserva.cabana|default:$reserva.cabana_id}</strong>
  del {$reserva.fecha_inicio} al {$reserva.fecha_fin}?
</p>

<form method="post" action="{$smarty.const.BASE_URL}?action=reservas&sub_action=borrar">
  <input type="hidden" name="csrf" value="{$csrf}">
  <input type="hidden" name="id"   value="{$reserva.id}">
  <button type="submit" class="btn btn-sm btn-danger">Sí, eliminar</button>
  <a href="{$smarty.const.BASE_URL}?action=reservas&sub_action=listar">Cancelar</a>
</form>

{include file="footer.html"}
