{include file="header.html"}

<h2>Agregar Persona</h2>

<form action="{$BASE_URL}personas/guardar" method="post">
  <label for="nombre">Nombre:</label><br>
  <input type="text" id="nombre" name="nombre" required><br><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" required><br><br>

  <label for="telefono">Teléfono:</label><br>
  <input type="text" id="telefono" name="telefono"><br><br>

  <button type="submit">Guardar</button>
  <a href="{$BASE_URL}personas">Cancelar</a>
</form>

{include file="footer.html"}
