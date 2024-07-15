<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (!isset($_POST['confirmar_eliminar'])) {

	echo '
        <script>
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará la inscripción seleccionada. ¿Deseas continuar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement("form");
                    form.method = "post";
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "confirmar_eliminar";
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        </script>
    ';
} else {
	$userclass_id_del = limpiar_cadena($_GET['userclass_id_del']);

	$check_userclass = conexion();
	$check_userclass = $check_userclass->query("SELECT * FROM usuario_clase WHERE userclass_id='$userclass_id_del'");

	if ($check_userclass->rowCount() == 1) {

		$datos = $check_userclass->fetch();

		$eliminar_userclass = conexion();
		$eliminar_userclass = $eliminar_userclass->prepare("DELETE FROM usuario_clase WHERE userclass_id=:id");

		$eliminar_userclass->execute([":id" => $userclass_id_del]);

		if ($eliminar_userclass->rowCount() == 1) {
			echo '
		<script>
			Swal.fire({
				position: "top-end",
				icon: "success",
				title: "INSCRIPCION ELIMINADA!",
				showConfirmButton: false,
				timer: 1000
			});
		</script>
	';
		} else {
			echo '
		<script>
			Swal.fire({
				position: "top-end",
				icon: "error",
				title: "¡Ocurrió un error inesperado!",
				text: "No se pudo eliminar la inscripción, por favor intente nuevamente"
			});
		</script>
	';
		}
		$eliminar_userclass = null;
	} else {
		echo '
	<script>
		Swal.fire({
			position: "top-end",
			icon: "error",
			title: "¡Ocurrió un error inesperado!",
			text: "El inscripción que intenta eliminar no existe"
		});
	</script>
';
	}
	$check_userclass = null;
}
?>