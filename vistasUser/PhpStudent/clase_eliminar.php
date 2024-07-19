<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$clase_id_del = limpiar_cadena($_GET['clase_id_del']);

if (!isset($_POST['confirmar_eliminar'])) {

    echo '
        <script>
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará la clase seleccionado. ¿Deseas continuar?",
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

    $check_clases = conexion();
    $check_clases = $check_clases->query("SELECT clase_id FROM clases WHERE clase_id='$clase_id_del'");

    if ($check_clases->rowCount() == 1) {

        $check_usuario_clase = conexion();
        $check_usuario_clase = $check_usuario_clase->query("SELECT clase_id FROM usuario_clase WHERE clase_id='$clase_id_del' LIMIT 1");

        if ($check_usuario_clase->rowCount() <= 0) {

            $eliminar_clases = conexion();
            $eliminar_clases = $eliminar_clases->prepare("DELETE FROM clases WHERE clase_id=:id");

            $eliminar_clases->execute([":id" => $clase_id_del]);

            if ($eliminar_clases->rowCount() == 1) {
                echo '
                    <script>
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "CLASE ELIMINADO!",
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
					text: "No se pudo eliminar la clase, por favor intente nuevamente"
				});
			</script>
		';
            }
            $eliminar_clases = null;
        } else {
            echo '
		<script>
			Swal.fire({
				position: "top-end",
				icon: "error",
				title: "¡Ocurrió un error inesperado!",
				text: "No podemos eliminar la clase ya que tiene usuarios asociados"
			});
		</script>
	';
        }
        $check_usuario_clase = null;
    } else {
        echo '
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "¡Ocurrió un error inesperado!",
                    text: "La clase que intenta eliminar no existe"
                });
            </script>
        ';
    }
    $check_clases = null;
}
?>