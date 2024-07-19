<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

$user_id_del = limpiar_cadena($_GET['user_id_del']);

if (!isset($_POST['confirmar_eliminar'])) {

    echo '
        <script>
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará al usuario seleccionado. ¿Deseas continuar?",
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

    $check_usuario = conexion();
    $check_usuario = $check_usuario->query("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion='$user_id_del'");

    if ($check_usuario->rowCount() == 1) {
        $check_usuario_clase = conexion();
        $check_usuario_clase = $check_usuario_clase->query("SELECT usuario_identificacion FROM usuario_clase WHERE usuario_identificacion='$user_id_del' LIMIT 1");

        if ($check_usuario_clase->rowCount() <= 0) {

            $eliminar_usuario = conexion();
            $eliminar_usuario = $eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_identificacion=:id");

            $eliminar_usuario->execute([":id" => $user_id_del]);

            if ($eliminar_usuario->rowCount() == 1) {
                echo '
                    <script>
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "¡USUARIO ELIMINADO!",
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
                            text: "No se pudo eliminar el usuario, por favor intente nuevamente"
                        });
                    </script>
                ';
            }
            $eliminar_usuario = null;
        } else {

            echo '
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "¡Ocurrió un error inesperado!",
                        text: "No podemos eliminar el usuario ya que tiene clases registradas"
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
                    text: "El usuario que intenta eliminar no existe"
                });
            </script>
        ';
    }
    $check_usuario = null;
}

?>