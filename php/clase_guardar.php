<?php
require_once "main.php";

$nombre = limpiar_cadena($_POST['clase_nombre']);
$ubicacion = limpiar_cadena($_POST['clase_ubicacion']);

$campo = '';

switch (true) {
    case ($nombre == ""):
        $campo = 'Nombre clase';
        break;
    case ($ubicacion == ""):
        $campo = 'Salón';
        break;

    default:
        break;
}

if ($campo != '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'No has llenado el campo de ' . $campo . ' que es obligatorio'
    ]);
    exit();
}

if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'La CLASE no coincide con el formato solicitado'
    ]);
    exit();
}

if ($ubicacion != "") {
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\- ]{2,50}", $ubicacion)) {  
        echo json_encode([
            'status' => 'error',
            'message' => 'El SALÓN no coincide con el formato solicitado'
        ]);
        exit();
    }
}

$check_nombre = conexion();
$check_nombre = $check_nombre->query("SELECT clase_nombre FROM clases WHERE clase_nombre='$nombre'");
if ($check_nombre->rowCount() > 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'La CLASE ingresada ya se encuentra registrada, por favor elija otro'
    ]);
    exit();
}
$check_nombre = null;

$guardar_clases = conexion();
$guardar_clases = $guardar_clases->prepare("INSERT INTO clases(clase_nombre,clase_ubicacion) VALUES(:nombre,:ubicacion)");

$marcadores = [
    ":nombre" => $nombre,
    ":ubicacion" => $ubicacion
];

$guardar_clases->execute($marcadores);

if ($guardar_clases->rowCount() == 1) {
    echo json_encode([
        'status' => 'success',
        'message' => 'La clase se registró con éxito'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No se pudo registrar la clase, por favor intente nuevamente'
    ]);
}
$guardar_clases = null;
