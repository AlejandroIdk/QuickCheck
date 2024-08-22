<?php
require_once "main.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['rol_nombre'])) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se recibió el dato requerido.
        </div>
    ';
    exit();
}

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
$stmt = $check_roles->prepare("SELECT rol_nombre FROM roles WHERE rol_nombre = :rolname");
$stmt->execute([':rolname' => $rol]);

if ($stmt->rowCount() > 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El ROL ingresado ya se encuentra registrado, por favor elija otro
        </div>
    ';
    exit();
}

$guardar_rol = conexion();
$stmt = $guardar_rol->prepare("INSERT INTO roles (rol_nombre) VALUES (:rolname)");
$result = $stmt->execute([':rolname' => $rol]);

if ($result) {
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
