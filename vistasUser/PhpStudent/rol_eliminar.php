<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

$rol_code_del = limpiar_cadena($_GET['rol_code_del']);

if (!isset($_POST['confirmar_eliminar'])) {

    echo '
        <script>
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará el rol seleccionado. ¿Deseas continuar?",
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
    $check_usuarios = conexion();
    $check_usuarios = $check_usuarios->prepare("SELECT COUNT(*) AS total FROM usuario WHERE rol_code = :code");
    $check_usuarios->execute([":code" => $rol_code_del]);
    $total_usuarios = $check_usuarios->fetch(PDO::FETCH_ASSOC)['total'];

    if ($total_usuarios > 0) {
        echo '
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "¡Ups, algo salió mal!",
                    text: "No se puede eliminar el rol porque tiene usuarios registrados",
                    toast: true,
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            </script>
        ';
    } else {

        $eliminar_rol = conexion();
        $eliminar_rol = $eliminar_rol->prepare("DELETE FROM roles WHERE rol_code=:code");
        $eliminar_rol->execute([":code" => $rol_code_del]);

        if ($eliminar_rol->rowCount() == 1) {

            echo '
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "¡ROL ELIMINADO!",
                        showConfirmButton: false,
                        toast: true,
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true
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
                        text: "No se pudo eliminar el rol, por favor intente nuevamente"
                        toast: true,
                        showConfirmButton: false,
                        timer: 2300,
                        timerProgressBar: true
                    });
                </script>
            ';
        }
        $eliminar_rol = null;
    }

    $check_usuarios = null;
}

?>