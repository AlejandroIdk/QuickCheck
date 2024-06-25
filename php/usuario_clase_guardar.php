<?php
require_once "../inc/session_start.php"; // Se inicia la sesión si aún no está iniciada.
require_once "main.php"; // Se incluye el archivo main.php que contiene funciones o configuraciones necesarias.

// Almacenando datos del formulario después de limpiarlos
$identificacion = limpiar_cadena($_POST['usuario_identificacion']); // Se limpia y almacena la identificación del usuario.
$clase_nombre = limpiar_cadena($_POST['clase_nombre']); // Se limpia y almacena el nombre de la clase.
$generated_code = $_POST['generated_code']; // Se obtiene el código generado del formulario.

// Verificando campos obligatorios
if ($identificacion == "" || $clase_nombre == "") {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit(); // Si algún campo obligatorio está vacío, se muestra un mensaje de error y se detiene la ejecución del script.
}

// Verificando existencia del usuario en la base de datos
$check_usuario = conexion()->query("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion='$identificacion'");
if ($check_usuario->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario no existe
        </div>
    ';
    exit(); // Si el usuario no existe, se muestra un mensaje de error y se detiene la ejecución.
}

// Verificando existencia de la clase en la base de datos
$check_clase = conexion()->query("SELECT clase_id FROM clases WHERE clase_nombre='$clase_nombre'");
if ($check_clase->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La clase seleccionada no existe
        </div>
    ';
    exit(); // Si la clase no existe, se muestra un mensaje de error y se detiene la ejecución.
}

$clase = $check_clase->fetch();
$clase_id = $clase['clase_id'];

// Verificando si el usuario ya está inscrito en la clase
$check_usuario_clase = conexion()->query("SELECT * FROM usuario_clase WHERE usuario_identificacion='$identificacion' AND clase_id='$clase_id'");
if ($check_usuario_clase->rowCount() > 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario ya está inscrito en esta clase
        </div>
    ';
    exit(); // Si el usuario ya está inscrito en la clase, se muestra un mensaje de error y se detiene la ejecución.
}

// Guardando datos en la tabla usuario_clase
try {
    $guardar_usuario_clase = conexion()->prepare("INSERT INTO usuario_clase (clase_id, usuario_identificacion, generated_code) VALUES (:clase_id, :identificacion, :generated_code)");

    $guardar_usuario_clase->bindParam(":clase_id", $clase_id, PDO::PARAM_INT);
    $guardar_usuario_clase->bindParam(":identificacion", $identificacion, PDO::PARAM_STR);
    $guardar_usuario_clase->bindParam(":generated_code", $generated_code, PDO::PARAM_STR);

    $guardar_usuario_clase->execute(); // Ejecuta la inserción en la base de datos.

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
    echo "Error:" . $e->getMessage(); // Captura y muestra cualquier excepción de PDO.
}
?>
