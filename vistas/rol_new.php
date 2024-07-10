<div class="container is-fluid mb-6">
	<h1 class="title">Roles</h1>
	<h2 class="subtitle">Nuevo Rol</h2>
</div>
<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/rol_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Nombres</label>
					<input class="input" type="text" name="rol_nombre" pattern="{3,40}" maxlength="40" required>
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>