<div class="container is-fluid mb-6">
	<h1 class="title">Roles</h1>
	<h2 class="subtitle">Nuevo Rol</h2>
</div>
<div class="container pb-6 pt-6">

<div class="form-rest"></div>

	<form action="./php/rol_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
		<div class="columns">
			<div class="column">
				<div class="control">
					<label for="rol_nombre">Nombre:</label>
					<input class="input" type="text" name="rol_nombre" id="rol_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" minlength="5" maxlength="40">
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>
