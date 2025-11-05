{include file="header.html"}

<h2>Eliminar Persona</h2>

<p>¿Estás segura de que querés eliminar a la persona <strong>{$persona.nombre}</strong>?</p>

<form action="{$BASE_URL}personas/eliminar/{$persona.id}" method="post">
  <button type="submit">Sí, eliminar</button>
  <a href="{$BASE_URL}personas">Cancelar</a>
</form>

{include file="footer.html"}
