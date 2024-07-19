<div class="main">
    <div class="attendance-container row mt-5 justify-content-center">

        <div class="col-12 col-md-4 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Escanea tu Código QR para Asistencia</h5>
                    <div class="scanner-con mb-3">
                        <video id="interactive" class="viewport w-100" style="max-height: 300px;"></video>
                    </div>

                    <div class="qr-detected-container mt-3" style="display: none;">
                        <form id="attendanceForm" action="./php/escannear_usuario.php" method="POST">
                            <input type="hidden" id="detected-qr-code" name="qr_code">
                            <h4 class="text-center">¡Código QR del usuario detectado!</h4>
                            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 mb-4">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <?php
                    include('./php/main.php');
                    include('./vistas/attendance_list.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<!-- Instascan JS -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>
    let scanner;

    function startScanner() {
        scanner = new Instascan.Scanner({
            video: document.getElementById('interactive')
        });

        scanner.addListener('scan', function(content) {
            $("#detected-qr-code").val(content);
            console.log(content);
            scanner.stop();

            document.querySelector(".qr-detected-container").style.display = 'block';
            document.querySelector(".scanner-con").style.display = 'none';

            // Automatically submit the form
            document.getElementById('attendanceForm').submit();
        });

        Instascan.Camera.getCameras()
            .then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No se encontraron cámaras disponibles.');
                    alert('No se encontraron cámaras disponibles.');
                }
            })
            .catch(function(err) {
                console.error('Error de acceso a la cámara:', err);
                alert('Error de acceso a la cámara: ' + err);
            });
    }

    document.addEventListener('DOMContentLoaded', startScanner);
</script>