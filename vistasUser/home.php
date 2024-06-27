<?php
require_once "./php/main.php";
$conexion = conexion(); // Asumo que esto establece la conexión correctamente

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . $conexion->errorInfo());
}

// Preparar consulta SQL
try {
    $stmt = $conexion->prepare("SELECT * FROM usuario_clase INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id");
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<div class="main">
    <div class="student-container">
        <div class="student-list mt-5">
            <div class="container">
                <?php foreach ($result as $row): ?>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-3 text-center">
                            <h4><?= $_SESSION['nombre'] ?></h4>
                            <h6 class="mt-3">Qr de la clase de : <?= $row["clase_nombre"] ?></h6>
                            <button class="btn btn-success mt-3" data-toggle="modal" data-target="#qrCodeModal<?= $row["userclass_id"] ?>">
                                Ver tu QR
                            </button>
                        </div>
                    </div>

                    <!-- Modal QR -->
                    <div class="modal fade" id="qrCodeModal<?= $row["userclass_id"] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?= $_SESSION['nombre'] ?> QR</h5>
  
                                </div>
                                <div class="modal-body text-center">
                                    <?php 
                                    // Verifica la generación del código QR y su URL
                                    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($row["generated_code"]);
                                    ?>
                                    <img src="<?= $qrCodeUrl ?>" alt="QR Code">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

