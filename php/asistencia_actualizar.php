<?php
require_once "main.php";

$id = limpiar_cadena($_POST['asistencia_id']);
$usuario_identificacion = limpiar_cadena($_POST['usuario_identificacion']);
$clase_id = limpiar_cadena($_POST['clase_id']);
$fecha = limpiar_cadena($_POST['fecha']);

$check_asistencia = conexion()->prepare("SELECT * FROM asistencia WHERE asistencia_id = :id");
$check_asistencia->execute([':id' => $id]);

if ($check_asistencia->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La asistencia no existe en el sistema
        </div>
    ';
    exit();
} else {
    $datos = $check_asistencia->fetch();
}

if ($usuario_identificacion == "" || $clase_id == "" || $fecha == "") {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

$check_usuario = conexion()->prepare("SELECT * FROM usuario WHERE usuario_identificacion = :identificacion");
$check_usuario->execute([':identificacion' => $usuario_identificacion]);

if ($check_usuario->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario seleccionado no existe
        </div>
    ';
    exit();
}

$check_clase = conexion()->prepare("SELECT * FROM clases WHERE clase_id = :clase_id");
$check_clase->execute([':clase_id' => $clase_id]);

if ($check_clase->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La clase seleccionada no existe
        </div>
    ';
    exit();
}

$actualizar_asistencia = conexion()->prepare("UPDATE asistencia SET usuario_identificacion = :usuario_identificacion, clase_id = :clase_id, fecha = :fecha WHERE asistencia_id = :id");

$marcadores = [
    ":usuario_identificacion" => $usuario_identificacion,
    ":clase_id" => $clase_id,
    ":fecha" => $fecha,
    ":id" => $id
];

if ($actualizar_asistencia->execute($marcadores)) {
    echo '
        <div class="notification is-info is-light">
            <strong>¡Asistencia actualizada!</strong><br>
            La asistencia se actualizó con éxito
        </div>
    ';
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo actualizar la asistencia, por favor intente nuevamente
        </div>
    ';
}
