<?php

$rol_code_del = limpiar_cadena($_GET['rol_code_del']);

$check_usuarios = conexion();
$check_usuarios = $check_usuarios->prepare("SELECT COUNT(*) AS total FROM usuario WHERE rol_code = :code");
$check_usuarios->execute([":code" => $rol_code_del]);
$total_usuarios = $check_usuarios->fetch(PDO::FETCH_ASSOC)['total'];

if ($total_usuarios > 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ups, Algo salio mal!</strong><br>
            No se puede eliminar el rol porque tiene usuarios registrados
        </div>
    ';
} else {

    $eliminar_rol = conexion();
    $eliminar_rol = $eliminar_rol->prepare("DELETE FROM roles WHERE rol_code=:code");
    $eliminar_rol->execute([":code" => $rol_code_del]);
    if ($eliminar_rol->rowCount() == 1) {
        echo '
            <div class="notification is-info is-light">
                <strong>¡ROL ELIMINADO!</strong><br>
                Los datos del rol se eliminaron con éxito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo eliminar el rol, por favor intente nuevamente
            </div>
        ';
    }
    $eliminar_rol = null;
}

$check_usuarios = null;
