{include file="header.html"}

<h2>Nueva reserva</h2>

<form method="post" action="{$BASE_URL}?action=reservas&sub_action=agregar">
  
  <label>Persona:</label>
  <select name="persona_id" required style="min-width:220px">
    <option value="">-- Elegir persona --</option>
    {foreach $personas as $p}
      <option value="{$p.id}">{$p.nombre|escape}</option>
    {/foreach}
  </select>

  <label>Cabaña:</label>
  <select name="cabana_id" required style="min-width:220px">
    <option value="">-- Elegir cabaña --</option>
    {foreach $cabanas as $c}
      <option value="{$c.id}">{$c.nombre|escape}</option>
    {/foreach}
  </select>

  <label>Fecha de entrada:</label>
  <input type="date" name="fecha_inicio" required>

  <label>Fecha de salida:</label>
  <input type="date" name="fecha_fin" required>

  <button type="submit">Guardar</button>
  <a href="{$BASE_URL}?action=reservas&sub_action=listar">Cancelar</a>
</form>

{include file="footer.html"}
