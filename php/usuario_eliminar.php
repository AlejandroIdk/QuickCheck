<?php

// Almacenando datos
$user_id_del = limpiar_cadena($_GET['user_id_del']); // Se obtiene y limpia el ID del usuario a eliminar desde la variable GET.

// Verificando usuario
$check_usuario = conexion(); // Se establece la conexión a la base de datos.
$check_usuario = $check_usuario->query("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion='$user_id_del'");

if ($check_usuario->rowCount() == 1) { // Si se encontró el usuario en la base de datos.

    $check_usuario_clase = conexion(); // Se verifica si el usuario tiene clases asociadas.
    $check_usuario_clase = $check_usuario_clase->query("SELECT usuario_identificacion FROM usuario_clase WHERE usuario_identificacion='$user_id_del' LIMIT 1");

    if ($check_usuario_clase->rowCount() <= 0) { // Si el usuario no tiene clases asociadas, se procede con la eliminación.

        $eliminar_usuario = conexion(); // Se prepara la consulta para eliminar al usuario.
        $eliminar_usuario = $eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_identificacion=:id");

        $eliminar_usuario->execute([":id" => $user_id_del]); // Se ejecuta la eliminación.

        if ($eliminar_usuario->rowCount() == 1) { // Si se eliminó correctamente el usuario.
            echo '
                <div class="notification is-info is-light">
                    <strong>¡USUARIO ELIMINADO!</strong><br>
                    Los datos del usuario se eliminaron con éxito
                </div>
            ';
        } else { // Si ocurrió un error al eliminar el usuario.
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo eliminar el usuario, por favor intente nuevamente
                </div>
            ';
        }
        $eliminar_usuario = null; // Se libera la variable de la consulta preparada.
    } else { // Si el usuario tiene clases asociadas y no puede ser eliminado.
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No podemos eliminar el usuario ya que tiene clases registradas
            </div>
        ';
    }
    $check_usuario_clase = null; // Se libera la variable de la consulta de clases asociadas.
} else { // Si el usuario no existe en la base de datos.
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El USUARIO que intenta eliminar no existe
        </div>
    ';
}
$check_usuario = null; // Se libera la variable de la consulta principal de usuario.
?>
