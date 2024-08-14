<?php

require_once "./php/main.php";
$conexion = conexion();

if (!$conexion) {
    die("Error de conexión: " . $conexion->errorInfo());
}

if (!isset($_SESSION['id'])) {
    die("ID de usuario no encontrado en la sesión.");
}

try {
    $stmt = $conexion->prepare("SELECT * FROM usuario_clase INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id WHERE usuario_clase.usuario_identificacion = :usuario_identificacion");
    $stmt->bindParam(':usuario_identificacion', $_SESSION['id'], PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<main id="main" class="main">
    <div class="student-container">
        <div class="student-list mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <?php foreach ($result as $row): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= htmlspecialchars($_SESSION['id']) ?> 
                                        <span>| <?= htmlspecialchars($row["clase_nombre"]) ?></span>
                                    </h5>
                                    <h6 class="mt-3">Tu QR</h6>
                                    <?php 
                                    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($row["generated_code"]);
                                    ?>
                                    <img src="<?= htmlspecialchars($qrCodeUrl) ?>" alt="QR Code" class="img-fluid mt-3" width="200px">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
