<main id="main" class="main">
	<div class="pagetitle">
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php?vista=rol_new">Crear Rol</a></li>
				<li class="breadcrumb-item"><a href="index.php?vista=rol_list">Lista de Roles</a></li>
				<li class="breadcrumb-item"><a href="index.php?vista=rol_search">Buscar Rol</a></li>
			</ol>
		</nav>
	</div>
	<?php include "./inc/btn_back.php"; ?>
	<div class="form-rest"></div>

	<form id="guardarRol" method="POST" autocomplete="off">
		<div class="columns">
			<div class="column">
				<div class="control">
					<label for="rol_nombre">Nombre:</label>
					<input class="input" type="text" name="rol_nombre" id="rol_nombre" pattern="[a-z0-9A-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" minlength="5" maxlength="40" required>
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>

	<script>
		document.getElementById('guardarRol').addEventListener('submit', function(event) {
			event.preventDefault();

			var formData = new FormData(this);

			fetch('./php/rol_guardar.php', {
					method: 'POST',
					body: formData
				})
				.then(response => response.text())
				.then(data => {
					Swal.fire({
						html: data,
						icon: data.includes('¡ROL REGISTRADO!') ? 'success' : 'error',
						title: data.includes('¡ROL REGISTRADO!') ? 'Éxito' : 'Error',
						confirmButtonText: 'Aceptar'
					});
				})
				.catch(error => {
					console.error('Error:', error);
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Ocurrió un error al procesar la solicitud. Por favor, intenta de nuevo.'
					});
				});
		});
	</script>

</main>