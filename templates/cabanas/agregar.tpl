{include file="header.html"}

<div class="container">
    <h2>Agregar Nueva Cabaña</h2>

    {* Mostrar mensajes de error (si el controlador lo envió después de una validación fallida) *}
    {if isset($mensaje_texto)}
        <div class="alert alert-danger" role="alert">
            {$mensaje_texto}
        </div>
    {/if}

    {* El action del formulario apunta al controlador y la sub_action 'agregar' *}
    <form action="{$base_url}?action=cabanas&sub_action=agregar" method="POST">
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Cabaña:</label>
            {* El campo 'nombre' es el que el controlador leerá en $_POST['nombre'] *}
            <input type="text" 
                   class="form-control" 
                   id="nombre" 
                   name="nombre" 
                   required
                   placeholder="Ej: Cabaña Familiar">
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Cabaña</button>
        
        {* Enlace para cancelar y volver al listado *}
        <a href="{$base_url}?action=cabanas&sub_action=listar" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>

{include file="footer.html"}