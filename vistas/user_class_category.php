
<body>
    <div class="main-container">
        <div class="attendance-container row">
            <div class="qr-container col-4">
                <div class="scanner-con">
                    <h5 class="text-center">Scan your QR Code here for attendance</h5>
                    <video id="interactive" class="viewport" width="100%"></video>
                </div>
                <div class="qr-detected-container" style="display: none;">
                    <form action="./php/escannear_usuario.php" method="POST">
                        <h4 class="text-center">Student QR Detected!</h4>
                        <input type="hidden" id="detected-qr-code" name="qr_code">
                        <button type="submit" class="btn btn-dark form-control">Submit Attendance</button>
                    </form>
                </div>
            </div>
            <div class="attendance-list col-8">
                <h4>List of Present Students</h4>
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="attendanceTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Identification</th>
                                <th scope="col">Class</th>
                                <th scope="col">Entry Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include ('./php/main.php');
                            try {
                                $conn = conexion();
                                $stmt = $conn->prepare("SELECT a.asistencia_id, u.usuario_identificacion, c.clase_nombre, a.fecha
                                    FROM asistencia a
                                    LEFT JOIN usuario u ON u.usuario_identificacion = a.usuario_identificacion
                                    LEFT JOIN usuario_clase uc ON uc.clase_id = a.clase_id AND uc.usuario_identificacion = a.usuario_identificacion
                                    LEFT JOIN clases c ON c.clase_id = a.clase_id");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                            
                                foreach ($result as $row) {
                                    $attendanceID = $row["asistencia_id"];
                                    $usuarioIdentificacion = $row["usuario_identificacion"];
                                    $claseNombre = $row["clase_nombre"];
                                    $horaEntrada = $row["fecha"]; // Assuming 'fecha' is the entry time column
                                
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $attendanceID ?></th>
                                        <td><?= $usuarioIdentificacion ?></td>
                                        <td><?= $claseNombre ?></td>
                                        <td><?= $horaEntrada ?></td>
                                        <td>
                                            <div class="action-button">
                                                <button class="btn btn-danger delete-button" onclick="deleteAttendance(<?= $attendanceID ?>)">X</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Instascan Js -->
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
            if (confirm("Do you want to remove this attendance?")) {
                window.location = "./endpoint/delete-attendance.php?attendance=" + id;
            }
        }
    </script>
</body>
</html>
