<?php
include('main.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['qr_code'])) {
        $qrCode = $_POST['qr_code'];

        try {
            $conn = conexion();

            // Obtener la información del usuario y la clase asociada al código QR
            $stmt = $conn->prepare("SELECT uc.usuario_identificacion, uc.clase_id, c.clase_nombre FROM usuario_clase uc
                LEFT JOIN clases c ON c.clase_id = uc.clase_id
                WHERE uc.generated_code = :generated_code LIMIT 1");
            $stmt->bindParam(':generated_code', $qrCode);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $usuarioIdentificacion = $result['usuario_identificacion'];
                $claseId = $result['clase_id'];
                $horaEntrada = date("Y-m-d H:i:s"); // Hora actual de entrada

                // Insertar registro de asistencia
                $stmt = $conn->prepare("INSERT INTO asistencia (usuario_identificacion, clase_id, fecha) VALUES (:usuario_identificacion, :clase_id, :fecha)");
                $stmt->bindParam(':usuario_identificacion', $usuarioIdentificacion);
                $stmt->bindParam(':clase_id', $claseId); // Utiliza el id correcto de la clase
                $stmt->bindParam(':fecha', $horaEntrada);
                $stmt->execute();

            } else {
                echo "No se encontró ningún estudiante asociado al código QR.";
            }
        } catch (PDOException $e) {
            echo "Error al registrar la asistencia: " . $e->getMessage();
        }
    } else {
        echo "No se detectó ningún código QR.";
    }
} else {
    echo "Método de solicitud incorrecto.";
}
?>
