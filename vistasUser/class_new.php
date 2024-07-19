<div class="container is-fluid mb-6">
	<h1 class="title">Clases</h1>
	<h2 class="subtitle">Nueva Clase</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest"></div>

	<form action="./php/clase_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
		<div class="columns">
			<div class="column">
				<div class="control">
					<label for="clase_nombre">Nombre:</label>
					<input class="input" type="text" name="clase_nombre" id="clase_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="150">
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Salón:</label>
					<input class="input" type="text" name="clase_ubicacion" id="clase_ubicacion" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="150">
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>