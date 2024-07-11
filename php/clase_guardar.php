<?php
require_once "main.php";

$nombre = limpiar_cadena($_POST['clase_nombre']);
$ubicacion = limpiar_cadena($_POST['clase_ubicacion']);

$campo = '';

// Determinar cuál campo está vacío o no válido y establecer el valor de $campo
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

// Si se determina que hay un campo vacío o no válido, mostrar el mensaje de error correspondiente
if ($campo != '') {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado el campo de ' . $campo . ' que es obligatorio
        </div>
    ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La CLASE no coincide con el formato solicitado
            </div>
        ';
    exit();
}

if ($ubicacion != "") {
    if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}", $ubicacion)) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El SALÓN no coincide con el formato solicitado
	            </div>
	        ';
        exit();
    }
}

$check_nombre = conexion();
$check_nombre = $check_nombre->query("SELECT clase_nombre FROM clases WHERE clase_nombre='$nombre'");
if ($check_nombre->rowCount() > 0) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La CLASE ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
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
    echo '
            <div class="notification is-info is-light">
                <strong>¡CLASE REGISTRADA!</strong><br>
                La clase se registro con exito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar la clase, por favor intente nuevamente
            </div>
        ';
}
$guardar_clases = null;
