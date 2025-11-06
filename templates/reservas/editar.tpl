{include file="header.html"}

<h2>Editar Reserva</h2>

<form method="post" action="{$BASE_URL}?action=reservas&sub_action=modificar&id={$reserva.id}">
  <label for="persona_id">Persona:</label><br>
  <select id="persona_id" name="persona_id" required>
    {foreach from=$personas item=p}
    <option value="{$p.id}" {if $p.id == $reserva.persona_id}selected{/if}>
      {$p.nombre}
      {if isset($p.dni)} (DNI: {$p.dni}){/if}
    </option>
{/foreach}
  </select><br><br>

  <label for="cabana_id">Cabaña:</label><br>
  <select id="cabana_id" name="cabana_id" required>
    {foreach from=$cabanas item=c}
      <option value="{$c.id}" {if $c.id == $reserva.cabana_id}selected{/if}>
        {$c.nombre}
      </option>
    {/foreach}
  </select><br><br>

  <label for="fecha_inicio">Fecha de entrada:</label><br>
  <input type="date" id="fecha_inicio" name="fecha_inicio" value="{$reserva.fecha_inicio}" required><br><br>

  <label for="fecha_fin">Fecha de salida:</label><br>
  <input type="date" id="fecha_fin" name="fecha_fin" value="{$reserva.fecha_fin}" required><br><br>

  <button type="submit">Actualizar</button>
  <a href="{$BASE_URL}?action=reservas&sub_action=listar">Cancelar</a>
</form>

{include file="footer.html"}