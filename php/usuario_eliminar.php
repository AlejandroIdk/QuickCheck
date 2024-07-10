<?php

$user_id_del = limpiar_cadena($_GET['user_id_del']);

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
                <div class="notification is-info is-light">
                    <strong>¡USUARIO ELIMINADO!</strong><br>
                    Los datos del usuario se eliminaron con éxito
                </div>
            ';
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo eliminar el usuario, por favor intente nuevamente
                </div>
            ';
        }
        $eliminar_usuario = null;
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No podemos eliminar el usuario ya que tiene clases registradas
            </div>
        ';
    }
    $check_usuario_clase = null;
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El USUARIO que intenta eliminar no existe
        </div>
    ';
}
$check_usuario = null;
