{include file="header.html"}
<h2>{$titulo}</h2>

{if isset($flash_error)}<p style="color:red">{$flash_error}</p>{/if}
{if isset($flash_success)}<p style="color:green">{$flash_success}</p>{/if}

<form method="post" action="{$base_url}?action=usuarios&sub_action=registro">
  <input type="hidden" name="csrf" value="{$csrf}">
  <p>
    <label>Nombre</label><br>
    <input type="text" name="nombre" required>
  </p>
  <p>
    <label>Contraseña</label><br>
    <input type="password" name="password" required>
  </p>
  <p>
    <label>Repetir contraseña</label><br>
    <input type="password" name="password2" required>
  </p>
  <p><button type="submit">Crear cuenta</button></p>
</form>

<p>¿Ya tenés cuenta? <a href="{$base_url}?action=usuarios&sub_action=login">Iniciá sesión</a></p>
{include file="footer.html"}
