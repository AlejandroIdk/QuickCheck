
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
	<?php
        include "./inc/btn_back.php";
    ?>

	<div class="col-12 col-md-12">
		<div class="card border-success ">
			<div class="card-body">

				<div class="container is-fluid mt-3">
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
									<input class="input" type="text" name="rol_nombre" id="rol_nombre" pattern="[a-z0-9A-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" minlength="5" maxlength="40">
								</div>
							</div>
						</div>
						<p class="has-text-centered">
							<button type="submit" class="button is-info is-rounded">Guardar</button>
						</p>
					</form>
				</div>

			</div>
		</div>
	</div>