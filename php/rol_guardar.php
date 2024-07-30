<?php
require_once "main.php";

$rol = limpiar_cadena($_POST['rol_nombre']);

if ($rol == "") {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado el campo Nombre que es obligatorio
            </div>
        ';
    exit();
}

// Verificación para asegurarse de que el campo tenga al menos una letra
if (!preg_match('/[a-zA-Z]/', $rol)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El campo debe contener al menos una letra
            </div>
        ';
    exit();
}

$check_roles = conexion();
$check_roles = $check_roles->query("SELECT rol_nombre FROM roles WHERE rol_nombre='$rol'");
if ($check_roles->rowCount() > 0) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El ROL ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
    exit();
}
$check_roles = null;

$guardar_rol = conexion();
$guardar_rol = $guardar_rol->prepare("INSERT INTO roles(rol_nombre) VALUES(:rolname)");

$marcadores = [
    ":rolname" => $rol
];

$guardar_rol->execute($marcadores);

if ($guardar_rol->rowCount() == 1) {
    echo '
            <div class="notification is-info is-light">
                <strong>¡ROL REGISTRADO!</strong><br>
                El rol se registró con éxito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el rol, por favor intente nuevamente
            </div>
        ';
}
$guardar_rol = null;
