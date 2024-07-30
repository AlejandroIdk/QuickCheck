<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=class_new">Crear Clase</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=class_list">Lista de Clases</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=class_search">Buscar Clase</a></li>
            </ol>
        </nav>
    </div>
    <?php
        include "./inc/btn_back.php";
    ?>
	<div class="container is-fluid">
		<h1 class="title">Clases</h1>
		<h2 class="subtitle">Actualizar Clase</h2>
	</div>

	<div class="container pb-6 pt-6">
		<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['category_id_up'])) ? $_GET['category_id_up'] : 0;
		$id = limpiar_cadena($id);

		$check_clases = conexion();
		$check_clases = $check_clases->query("SELECT * FROM clases WHERE clase_id='$id'");

		if ($check_clases->rowCount() > 0) {
			$datos = $check_clases->fetch();
		?>

			<div class="form-rest mb-6 mt-6"></div>

			<form action="./php/clase_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

				<input type="hidden" name="clase_id" value="<?php echo $datos['clase_id']; ?>" required>

				<div class="columns">
					<div class="column">
						<div class="control">
							<label>Nombre</label>
							<input class="input" type="text" name="clase_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['clase_nombre']; ?>">
						</div>
					</div>
					<div class="column">
						<div class="control">
							<label>Ubicación</label>
							<input class="input" type="text" name="clase_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}" maxlength="150" value="<?php echo $datos['clase_ubicacion']; ?>">
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
		$check_clases = null;
		?>
	</div>