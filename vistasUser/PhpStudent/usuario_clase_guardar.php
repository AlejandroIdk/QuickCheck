<?php
require_once "../inc/session_start.php";
require_once "main.php";

$identificacion = limpiar_cadena($_POST['usuario_identificacion']);
$clase_nombre = limpiar_cadena($_POST['clase_nombre']);
$generated_code = $_POST['generated_code'];

$campo = '';

// Determinar cuál campo está vacío o no válido y establecer el valor de $campo
switch (true) {
    case ($identificacion == ""):
        $campo = 'Identificación';
        break;
    case ($clase_nombre == ""):
        $campo = 'Nombre Clase';
        break;
    case ($generated_code == ""):
        $campo = 'Código QR';
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

$check_usuario = conexion()->query("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion='$identificacion'");
if ($check_usuario->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario no existe
        </div>
    ';
    exit();
}

$check_clase = conexion()->query("SELECT clase_id FROM clases WHERE clase_nombre='$clase_nombre'");
if ($check_clase->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La clase seleccionada no existe
        </div>
    ';
    exit();
}

$clase = $check_clase->fetch();
$clase_id = $clase['clase_id'];

$check_usuario_clase = conexion()->query("SELECT * FROM usuario_clase WHERE usuario_identificacion='$identificacion' AND clase_id='$clase_id'");
if ($check_usuario_clase->rowCount() > 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario ya está inscrito en esta clase
        </div>
    ';
    exit();
}

try {
    $guardar_usuario_clase = conexion()->prepare("INSERT INTO usuario_clase (clase_id, usuario_identificacion, generated_code) VALUES (:clase_id, :identificacion, :generated_code)");

    $guardar_usuario_clase->bindParam(":clase_id", $clase_id, PDO::PARAM_INT);
    $guardar_usuario_clase->bindParam(":identificacion", $identificacion, PDO::PARAM_STR);
    $guardar_usuario_clase->bindParam(":generated_code", $generated_code, PDO::PARAM_STR);

    $guardar_usuario_clase->execute();

    if ($guardar_usuario_clase->rowCount() == 1) {
        echo '
            <div class="notification is-info is-light">
                <strong>¡REGISTRO EXITOSO!</strong><br>
                El usuario ha sido inscrito en la clase con éxito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo inscribir al usuario en la clase, por favor inténtalo nuevamente
            </div>
        ';
    }
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}
