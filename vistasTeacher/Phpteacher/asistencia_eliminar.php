<?php
$asistencia_id_del = limpiar_cadena($_GET['asistencia_id_del']);


if (!isset($_POST['confirmar_eliminar'])) {

    echo '
        <script>
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará la asistencia seleccionada. ¿Deseas continuar?",
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
$check_asistencia = conexion();
$check_asistencia = $check_asistencia->query("SELECT * FROM asistencia WHERE asistencia_id='$asistencia_id_del'");

if ($check_asistencia->rowCount() == 1) {

	$datos = $check_asistencia->fetch();

	$eliminar_asistencia = conexion();
	$eliminar_asistencia = $eliminar_asistencia->prepare("DELETE FROM asistencia WHERE asistencia_id=:id");

	$eliminar_asistencia->execute([":id" => $asistencia_id_del]);

	if ($eliminar_asistencia->rowCount() == 1) {


		echo '
		<script>
			Swal.fire({
				position: "top-end",
				icon: "success",
				title: "ASISTENCIA ELIMINADO!",
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
				text: "No se pudo eliminar la asistencia, por favor intente nuevamente"
			});
		</script>
	';
	}
	$eliminar_asistencia = null;
} else {
    echo '
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "¡Ocurrió un error inesperado!",
                    text: "La asistencia que intenta eliminar no existe"
                });
            </script>
        ';
}
$check_asistencia = null;
}
?>