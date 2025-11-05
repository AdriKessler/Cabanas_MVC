{include file="header.html"}

<h2>Listado de Personas</h2>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>DNI</th>

  </tr>
  {foreach $personas as $p}
  <tr>
    <td>{$p.id}</td>
    <td>{$p.nombre}</td>
    <td>{$p.dni}</td>
    <td>
      <a href="{$BASE_URL}personas/editar/{$p.id}">Editar</a> |
      <a href="{$BASE_URL}personas/borrar/{$p.id}">Borrar</a>
    </td>
  </tr>
  {/foreach}
</table>

<a href="{$BASE_URL}personas/agregar">Agregar nueva persona</a>

{include file="footer.html"}
