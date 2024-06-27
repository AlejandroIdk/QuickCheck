<div class="main">
    <div class="attendance-container row mt-5">
        <!-- Contenedor para el escáner QR -->
        <div class="qr-container col-4">
            <div class="scanner-con">
                <h5 class="text-center">Scan your QR Code here for attendance</h5>
                <video id="interactive" class="viewport" width="100%"></video>
            </div>

            <!-- Contenedor para el formulario cuando se detecta un código QR -->
            <div class="qr-detected-container" style="display: none;">
                <form id="attendanceForm" action="./php/escannear_usuario.php" method="POST">
                    <h4 class="text-center">¡Código QR del Estudiante Detectado!</h4>
                    <input type="hidden" id="detected-qr-code" name="qr_code">
                </form>
            </div>
        </div>

        <!-- Contenedor para la lista de asistencias -->
        <div class="attendance-list col-8 mt-5">
            <h4>Lista de Estudiantes Actuales</h4>
            <div class="table-container table-responsive">
                <table class="table text-center table-sm" id="attendanceTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Identificación</th>
                            <th scope="col">Clase</th>
                            <th scope="col">Hora de Entrada</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        // Incluir el archivo main.php que contiene funciones y configuraciones generales
                        include ('./php/main.php');
                    
                        try {
                            // Establecer conexión a la base de datos
                            $conn = conexion(); // La función 'conexion()' probablemente retorna la conexión PDO
                            
                            // Preparar consulta SQL para obtener datos de asistencia
                            $stmt = $conn->prepare("SELECT a.asistencia_id, u.usuario_identificacion, c.clase_nombre, a.fecha
                            FROM asistencia a
                            LEFT JOIN usuario u ON u.usuario_identificacion = a.usuario_identificacion
                            LEFT JOIN usuario_clase uc ON uc.clase_id = a.clase_id AND uc.usuario_identificacion = a.usuario_identificacion
                            LEFT JOIN clases c ON c.clase_id = uc.clase_id");
                        
                            
                            // Ejecutar la consulta
                            $stmt->execute();
                            
                            // Obtener todos los resultados
                            $result = $stmt->fetchAll();
                        
                            // Iterar sobre cada fila de resultados
                            foreach ($result as $row) {
                                $attendanceID = $row["asistencia_id"];
                                $usuarioIdentificacion = $row["usuario_identificacion"];
                                $claseId = $row["clase_nombre"];
                                $horaEntrada = $row["fecha"]; // Asumiendo que 'fecha' es la columna de hora de entrada
                            
                                ?>
                            
                                <!-- Mostrar cada fila de la tabla con los datos obtenidos -->
                                <tr>
                                    <th scope="row"><?= $attendanceID ?></th>
                                    <td><?= $usuarioIdentificacion ?></td>
                                    <td><?= $claseId ?></td>
                                    <td><?= $horaEntrada ?></td>
                                    <td>
                                        <div class="action-button">
                                            <!-- Botón para eliminar una asistencia -->
                                            <button class="btn btn-danger delete-button" onclick="deleteAttendance(<?= $attendanceID ?>)">X</button>
                                        </div>
                                    </td>
                                </tr>
                            
                                <?php
                            }
                        } catch (PDOException $e) {
                            // Manejo de errores en caso de excepción PDO
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts al final del documento -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<!-- Instascan JS -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>
    let scanner;

    function startScanner() {
        scanner = new Instascan.Scanner({ video: document.getElementById('interactive') });

        scanner.addListener('scan', function (content) {
            $("#detected-qr-code").val(content);
            console.log(content);
            scanner.stop();

            document.querySelector(".qr-detected-container").style.display = '';
            document.querySelector(".scanner-con").style.display = 'none';

            // Automáticamente enviar el formulario
            document.getElementById('attendanceForm').submit();
        });

        Instascan.Camera.getCameras()
            .then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            })
            .catch(function (err) {
                console.error('Camera access error:', err);
                alert('Camera access error: ' + err);
            });
    }

    document.addEventListener('DOMContentLoaded', startScanner);

    function deleteAttendance(id) {
        if (confirm("¿Seguro que deseas eliminar esta asistencia?")) {
            window.location = "./endpoint/delete-attendance.php?attendance=" + id;
        }
    }
</script>
