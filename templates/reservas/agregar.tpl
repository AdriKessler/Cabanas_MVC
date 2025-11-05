{include file="header.tpl"}

<h2>Nueva reserva</h2>

<form method="post" action="{$BASE_URL}?action=reservas&sub_action=agregar">
  <select name="persona_id" required>…</select>
  <select name="cabana_id"  required>…</select>
  <input type="date" name="fecha_inicio" required>
  <input type="date" name="fecha_fin"    required>
  <button type="submit">Guardar</button>
  <a href="{$BASE_URL}?action=reservas&sub_action=listar">Cancelar</a>
</form>

{include file="footer.tpl"}
