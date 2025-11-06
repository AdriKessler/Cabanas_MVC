{include file="header.html"}

<h2>Eliminar Reserva</h2>

<p>
  ¿Estás segura de que querés eliminar la reserva de 
  <strong>{$reserva.persona_nombre|default:$reserva.persona|default:$reserva.persona_id}</strong> 
  en la cabaña <strong>{$reserva.cabana_nombre|default:$reserva.cabana|default:$reserva.cabana_id}</strong>
  del {$reserva.fecha_inicio} al {$reserva.fecha_fin}?
</p>

<form id="frm-del" action="{$BASE_URL}reservas?sub_action=borrar&id={$reserva.id}">
  <input type="hidden" name="id" value="{$reserva.id}">
  <input type="hidden" name="csrf" value="{$csrf}">
</form>

<button form="frm-del" type="submit" formmethod="post">Sí, eliminar</button>
<a href="{$BASE_URL}reservas?sub_action=listar">Cancelar</a>

{include file="footer.html"}
