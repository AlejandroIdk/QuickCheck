<?php
include('main.php');

$mensaje = ''; // Define una variable $mensaje con un valor predeterminado vacío
$tipoMensaje = 'success'; // Define una variable $tipoMensaje con un valor predeterminado 'success'

// Comprueba si la solicitud es de tipo POST y si el parámetro 'qr_code' está presente en la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qr_code'])) {
    $qrCode = $_POST['qr_code']; // Obtiene el valor del código QR enviado en la solicitud POST

    try {
        $conn = conexion(); // Llama a la función de conexión para obtener un objeto PDO que conecta con la base de datos

        date_default_timezone_set('America/Bogota'); // Establece la zona horaria a Bogotá

        // Prepara una consulta SQL para verificar si el código QR ya ha sido escaneado hoy
        $verficarQr = $conn->prepare("
            SELECT COUNT(*) as count
            FROM asistencia
            WHERE usuario_identificacion = (
                SELECT usuario_identificacion
                FROM usuario_clase
                WHERE generated_code = :generated_code
                LIMIT 1
            )
            AND fecha >= CURDATE()
        ");
        $verficarQr->bindParam(':generated_code', $qrCode); // Asocia el parámetro :generated_code con el valor de $qrCode
        $verficarQr->execute(); // Ejecuta la consulta
        $checkResult = $verficarQr->fetch(PDO::FETCH_ASSOC); // Obtiene el resultado de la consulta en formato asociativo

        // Verifica si el código QR ya ha sido registrado para el día de hoy
        if ($checkResult['count'] > 0) {
            $mensaje = 'Su asistencia ya fue marcada.'; // Mensaje si la asistencia ya ha sido marcada
            $tipoMensaje = 'warning'; // Establece el tipo de mensaje a 'warning' para notificar al usuario
        } else {
            // Si la asistencia no ha sido marcada, procede a marcar la asistencia
            $stmt = $conn->prepare("
                SELECT uc.usuario_identificacion, uc.clase_id, c.clase_nombre 
                FROM usuario_clase uc
                LEFT JOIN clases c ON c.clase_id = uc.clase_id
                WHERE uc.generated_code = :generated_code 
                LIMIT 1
            ");
            $stmt->bindParam(':generated_code', $qrCode); // Asocia el parámetro :generated_code con el valor de $qrCode
            $stmt->execute(); // Ejecuta la consulta
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Obtiene el resultado de la consulta en formato asociativo

            // Verifica si se encontró un resultado para el código QR
            if ($result) {
                $usuarioIdentificacion = $result['usuario_identificacion']; // Obtiene la identificación del usuario
                $claseId = $result['clase_id']; // Obtiene el ID de la clase
                $horaEntrada = date("Y-m-d H:i:s"); // Obtiene la fecha y hora actual

                // Prepara una consulta SQL para insertar la asistencia en la base de datos
                $asistenciaInsert = $conn->prepare("
                    INSERT INTO asistencia (usuario_identificacion, clase_id, fecha) 
                    VALUES (:usuario_identificacion, :clase_id, :fecha)
                ");
                $asistenciaInsert->bindParam(':usuario_identificacion', $usuarioIdentificacion); // Asocia el parámetro :usuario_identificacion con el valor obtenido
                $asistenciaInsert->bindParam(':clase_id', $claseId); // Asocia el parámetro :clase_id con el valor obtenido
                $asistenciaInsert->bindParam(':fecha', $horaEntrada); // Asocia el parámetro :fecha con el valor de la hora actual
                $asistenciaInsert->execute(); // Ejecuta la consulta para insertar la asistencia

                $mensaje = '¡ASISTENCIA REGISTRADA!'; // Mensaje si la asistencia ha sido registrada correctamente
            } else {
                $mensaje = 'Código QR no válido o no está asociado a una clase.'; // Mensaje si el código QR no es válido
                $tipoMensaje = 'error'; // Establece el tipo de mensaje a 'error' para notificar al usuario
            }
        }

        $conn = null; // Cierra la conexión a la base de datos
    } catch (PDOException $e) {
        $mensaje = 'Error en la base de datos: ' . $e->getMessage(); // Mensaje en caso de error en la base de datos
        $tipoMensaje = 'error'; // Establece el tipo de mensaje a 'error' para notificar al usuario
    }

    // Redirige al usuario a la página principal con el mensaje y el tipo de mensaje codificados en la URL
    header('Location: ../index.php?vista=scanner_user&mensaje=' . urlencode($mensaje) . '&tipo=' . urlencode($tipoMensaje));
    exit(); // Termina la ejecución del script
}
