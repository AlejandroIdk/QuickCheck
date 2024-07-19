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

<!-- Instascan JS -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>
    // Declara una variable global 'scanner' para almacenar la instancia del escáner
    let scanner;

    // Esta función se llama cuando se carga el DOM
    function startScanner() {
        // Crea una nueva instancia de Instascan.Scanner y la asigna a la variable 'scanner'
        scanner = new Instascan.Scanner({
            video: document.getElementById('interactive')  // Asigna el elemento de video como la fuente del escáner
        });

        // Añade un listener para el evento 'scan', que se activa cuando se detecta un código QR
        scanner.addListener('scan', function(content) {
            // Cuando se detecta un código QR, asigna el contenido del código al campo oculto con id 'detected-qr-code'
            $("#detected-qr-code").val(content);
            console.log(content);  // Muestra el contenido del código QR en la consola

            // Detiene el escáner después de detectar un código QR
            scanner.stop();

            // Muestra el contenedor que indica que se detectó un código QR
            document.querySelector(".qr-detected-container").style.display = 'block';

            // Oculta el contenedor del escáner
            document.querySelector(".scanner-con").style.display = 'none';

            // Automáticamente envía el formulario con id 'attendanceForm'
            document.getElementById('attendanceForm').submit();
        });

        // Obtiene las cámaras disponibles y luego inicia el escáner con la primera cámara encontrada
        Instascan.Camera.getCameras()
            .then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);  // Inicia el escáner con la primera cámara encontrada
                } else {
                    console.error('No se encontraron cámaras disponibles.');
                    alert('No se encontraron cámaras disponibles.');  // Muestra una alerta si no hay cámaras disponibles
                }
            })
            .catch(function(err) {
                console.error('Error de acceso a la cámara:', err);
                alert('Error de acceso a la cámara: ' + err);  // Muestra una alerta si hay un error al acceder a la cámara
            });
    }

    // Se asegura de que la función startScanner se ejecute cuando se carga el DOM
    document.addEventListener('DOMContentLoaded', startScanner);
</script>
