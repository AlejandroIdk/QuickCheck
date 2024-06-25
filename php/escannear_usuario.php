<?php
include("main.php");
$pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['qr_code'])) {
        $qrCode = $_POST['qr_code'];

        $selectStmt = $pdo("SELECT usuario_identificacion, userclass_id, fecha FROM asistencia WHERE generated_code = :generated_code");
        $selectStmt->bindParam(":generated_code", $qrCode, PDO::PARAM_STR);

        if ($selectStmt->execute()) {
            $result = $selectStmt->fetch();
            if ($result !== false) {
                $usuarioIdentificacion = $row["usuario_identificacion"];
                $claseNombre = $row["userclass_id"];
                $horaEntrada = $timeIn = date("Y-m-d H:i:s");
            } else {
                echo "No student found in QR Code";
            }
        } else {
            echo "Failed to execute the statement.";
        }


        try {
            $stmt = $pdo("INSERT INTO asistencia (usuario_identificacion, userclass_id, time_in) VALUES (:usuario_identificacion, userclass_id, :time_in)");
            
            $stmt->bindParam(":usuario_identificacion", $usuarioIdentificacion, PDO::PARAM_STR); 
            $stmt->bindParam(":userclass_id", $claseNombre, PDO::PARAM_STR); 
            $stmt->bindParam(":time_in", $horaEntrada, PDO::PARAM_STR); 

            $stmt->execute();

            // header("Location: http://localhost/qr-code-attendance-system/index.php");

            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                // window.location.href = 'http://localhost/qr-code-attendance-system/index.php';
            </script>
        ";
    }
}
?>
