{include file="header.html"}

<h2>Listado de Reservas</h2>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Persona</th>
    <th>Cabaña</th>
    <th>Entrada</th>
    <th>Salida</th>
  </tr>
  {foreach $reservas as $r}
  <tr>
    <td>{$r.id}</td>
    <td>{$r.persona}</td>
    <td>{$r.cabana}</td>
    <td>{$r.entrada}</td>
    <td>{$r.salida}</td>
    <td>
      <a href="{$BASE_URL}?action=reservas&sub_action=modificar&id={$r.id}">Editar</a> |
      <a href="{$BASE_URL}?action=reservas&sub_action=borrar&id={$r.id}">Borrar</a>
    </td>
  </tr>
  {/foreach}
</table>

<a href="{$BASE_URL}?action=reservas&sub_action=agregar">Agregar nueva reserva</a>

{include file="footer.html"}
