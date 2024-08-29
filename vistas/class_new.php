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
		<h2 class="subtitle">Nueva Clase</h2>
	</div>

	<div class="container pb-6 pt-6">
		<form id="formularioClase" class="FormularioAjax" autocomplete="off">
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
						<input class="input" type="text" name="clase_ubicacion" id="clase_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\- ]{2,50}" maxlength="150">
					</div>
				</div>
			</div>
			<p class="has-text-centered">
				<button type="submit" class="button is-info is-rounded">Guardar</button>
			</p>
		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.FormularioAjax');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const formData = new FormData(form);

        fetch('./php/clase_guardar.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            } else if (data.status === 'success') {
                Swal.fire({
                    title: 'ATENCION',
                    text: "¿Està seguro de crear està clase?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, enviar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: data.message
                        }).then(() => {
                            window.location.reload(); 
                        });
                    }
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud.'
            });
        });
    });
});
    </script>
