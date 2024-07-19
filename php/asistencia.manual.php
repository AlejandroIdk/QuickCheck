<?php
date_default_timezone_set('America/Bogota');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "main.php";

    // Obtener y limpiar los datos del formulario
    $usuario_identificacion = limpiar_cadena($_POST['usuario_identificacion'] ?? '');
    $clase_id = limpiar_cadena($_POST['clase_id'] ?? '');
    $fecha = limpiar_cadena($_POST['fecha'] ?? '');

    // Validación de campos obligatorios
    $campos_vacios = [];
    if ($usuario_identificacion === '') {
        $campos_vacios[] = 'Usuario Identificación';
    }
    if ($clase_id === '') {
        $campos_vacios[] = 'Clase ID';
    }
    if ($fecha === '') {
        $campos_vacios[] = 'Fecha';
    }

    // Si hay campos vacíos, mostrar mensaje de error
    if (!empty($campos_vacios)) {
        echo '
            <div class="notification is-danger is-light">
                <strong> ¡Ocurrió un error inesperado!</strong><br>
                Los siguientes campos son obligatorios y no han sido llenados: ' . implode(', ', $campos_vacios) . '
            </div>
        ';
        exit();
    }

    // Preparar la consulta SQL para insertar la asistencia
    $guardar_asistencia = conexion()->prepare("INSERT INTO asistencia (usuario_identificacion, clase_id, fecha) VALUES (:identificacion, :clase, :fecha)");

    // Asignar los valores a los marcadores
    $marcadores = [
        ":identificacion" => $usuario_identificacion,
        ":clase" => $clase_id,
        ":fecha" => $fecha
    ];

    // Ejecutar la consulta
    if ($guardar_asistencia->execute($marcadores)) {
        echo '
            <div class="notification is-info is-light">
                <strong>ASISTENCIA REGISTRADA!</strong><br>
                La asistencia se registró exitosamente.
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar la asistencia, por favor intente nuevamente.
            </div>
        ';
    }
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se ha enviado el formulario correctamente.
        </div>
    ';
}
?>
