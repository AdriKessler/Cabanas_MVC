{include file="header.html"}

<h2>Listado de Cabañas</h2>

<table>
  <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
  {foreach from=$cabanas item=c}
    <tr>
      <td>{$c.id}</td>
      <td>{$c.nombre}</td>
      <td>
                <a href="{$base_url}?action=cabanas&sub_action=modificar&id={$c.id}">Modificar</a> |
                <a href="{$base_url}?action=cabanas&sub_action=borrar&id={$c.id}";">Borrar</a>
      </td>
    </tr>
  {/foreach}
</table>

<p><a href="{$base_url}?action=cabanas&sub_action=agregar">Agregar nueva cabaña</a></p>

{include file="footer.html"}