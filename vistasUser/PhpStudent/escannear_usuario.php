<?php
include('main.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qr_code'])) {
    $qrCode = $_POST['qr_code'];

    try {
        $conn = conexion();

        date_default_timezone_set('America/Bogota');

        $stmt = $conn->prepare("
            SELECT uc.usuario_identificacion, uc.clase_id, c.clase_nombre 
            FROM usuario_clase uc
            LEFT JOIN clases c ON c.clase_id = uc.clase_id
            WHERE uc.generated_code = :generated_code 
            LIMIT 1
        ");
        $stmt->bindParam(':generated_code', $qrCode);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $usuarioIdentificacion = $result['usuario_identificacion'];
            $claseId = $result['clase_id'];
            $horaEntrada = date("Y-m-d H:i:s");

            $stmtInsert = $conn->prepare("
                INSERT INTO asistencia (usuario_identificacion, clase_id, fecha) 
                VALUES (:usuario_identificacion, :clase_id, :fecha)
            ");
            $stmtInsert->bindParam(':usuario_identificacion', $usuarioIdentificacion);
            $stmtInsert->bindParam(':clase_id', $claseId);
            $stmtInsert->bindParam(':fecha', $horaEntrada);
            $stmtInsert->execute();

            $mensaje = 'Asistencia registrada con éxito!';
        } else {
            $mensaje = 'Código QR no válido o no asociado a ninguna clase.';
        }

        $conn = null;
    } catch (PDOException $e) {

        $mensaje = 'Error en la base de datos: ' . $e->getMessage();
    }

    header('Location: ../index.php?vista=scanner_user&mensaje=' . urlencode($mensaje));
    exit();
}
