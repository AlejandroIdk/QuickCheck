<div class="container pb-6 pt-6">
	<?php
	require_once "./php/main.php";

	$id = (isset($_GET['rol_code_up'])) ? $_GET['rol_code_up'] : 0;
	$id = limpiar_cadena($id);

	$check_rol = conexion();
	$check_rol = $check_rol->query("SELECT * FROM roles WHERE rol_code='$id'");

	if ($check_rol->rowCount() > 0) {
		$datos = $check_rol->fetch();
	?>

		<div class="form-rest mb-6 mt-6"></div>

		<h2 class="title has-text-centered"><?php echo $datos['rol_nombre']; ?></h2>

		<form action="./php/rol_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

			<input type="hidden" name="rol_code" value="<?php echo $datos['rol_code']; ?>" required>

			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Nombre</label>
						<input class="input" type="text" name="rol_nombre" pattern="{3,40}" maxlength="40" required value="<?php echo $datos['rol_nombre']; ?>">
					</div>
				</div>
			</div>
			<p class="has-text-centered">
				<button type="submit" class="button is-success is-rounded">Actualizar</button>
			</p>
		</form>
	<?php
	} else {
		include "./inc/error_alert.php";
	}
	$check_rol = null;
	?>
</div>