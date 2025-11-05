{include file="header.html"}

<h2>Editar Persona</h2>

<form action="{$BASE_URL}personas/actualizar/{$persona.id}" method="post">
  <label for="nombre">Nombre:</label><br>
  <input type="text" id="nombre" name="nombre" value="{$persona.nombre}" required><br><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" value="{$persona.email}" required><br><br>

  <label for="telefono">Teléfono:</label><br>
  <input type="text" id="telefono" name="telefono" value="{$persona.telefono}"><br><br>

  <button type="submit">Actualizar</button>
  <a href="{$BASE_URL}personas">Cancelar</a>
</form>

{include file="footer.html"}
