<main id="main" class="main">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <?php
                        require_once "./php/main.php";

                        // Verificar si se solicitó eliminar una asistencia
                        if (isset($_GET['asistencia_id_del'])) {
                            require_once "./php/asistencia_eliminar.php";
                        }

                        $conexion = conexion();

                        // Consultar las asistencias registradas
                        $consulta = $conexion->query("SELECT a.asistencia_id, u.usuario_identificacion, u.usuario_nombre, u.usuario_apellido, c.clase_nombre, c.clase_ubicacion, a.fecha 
                               FROM asistencia a
                               INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                               INNER JOIN clases c ON a.clase_id = c.clase_id
                               ORDER BY a.fecha DESC");
                        // Obtener todos los resultados de la consulta
                        $asistencia = $consulta->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <div class="container is-fluid mt-3">
                            <h1 class="title">Usuarios</h1>
                            <h2 class="subtitle">Lista de Usuarios</h2>
                        </div>

                        <div class="container pb-6 pt-4">
                            <div class="table-responsive">
                                <table id="tablaASistencia" class="table table-striped table-bordered nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Identificación</th>
                                            <th>Clase</th>
                                            <th>Salón</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($asistencia as $ass) : ?>
                                            <tr>
                                                <td><?php echo $ass['usuario_identificacion']; ?></td>
                                                <td><?php echo $ass['clase_nombre']; ?></td>
                                                <td><?php echo $ass['clase_ubicacion']; ?></td>
                                                <td><?php echo $ass['usuario_nombre']; ?></td>
                                                <td><?php echo $ass['usuario_apellido']; ?></td>
                                                <td><?php echo $ass['fecha']; ?></td>
                                                <td>
                                                    <a href="index.php?vista=attendance_update&attendance_id_up=<?php echo $ass['asistencia_id']; ?>" title="Editar">
                                                        <i class="fas fa-edit" style="color: green;"></i>
                                                    </a>
                                                    |
                                                    <a href="index.php?vista=asistencia_eliminar&asistencia_id_del=<?php echo $ass['asistencia_id']; ?>" title="Eliminar">
                                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir DataTables CSS/JS desde CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Incluir Instascan JS desde CDN -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>
        // Declara una variable global 'scanner' para almacenar la instancia del escáner
        let scanner;

        // Esta función se llama cuando se carga el DOM
        function startScanner() {
            // Crea una nueva instancia de Instascan.Scanner y la asigna a la variable 'scanner'
            scanner = new Instascan.Scanner({
                video: document.getElementById('interactive') // Asigna el elemento de video como la fuente del escáner
            });

            // Añade un listener para el evento 'scan', que se activa cuando se detecta un código QR
            scanner.addListener('scan', function(content) {
                // Cuando se detecta un código QR, asigna el contenido del código al campo oculto con id 'detected-qr-code'
                $("#detected-qr-code").val(content);
                console.log(content); // Muestra el contenido del código QR en la consola

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
                        scanner.start(cameras[0]); // Inicia el escáner con la primera cámara encontrada
                    } else {
                        console.error('No se encontraron cámaras disponibles.');
                        alert('No se encontraron cámaras disponibles.'); // Muestra una alerta si no hay cámaras disponibles
                    }
                })
                .catch(function(err) {
                    console.error('Error de acceso a la cámara:', err);
                    alert('Error de acceso a la cámara: ' + err); // Muestra una alerta si hay un error al acceder a la cámara
                });
        }

        // Inicializa DataTables y configura la tabla de asistencia
        $(document).ready(function() {
            $('#tablaASistencia').DataTable({
                responsive: true, // Hacer que la tabla sea responsiva
                dom: 'Bfrtip', // Configura los elementos a mostrar: Botones, filtro, tabla
                buttons: [
                    {
                        extend: 'copy', // Botón para copiar datos al portapapeles
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Especifica qué columnas se copiarán
                        }
                    },
                    {
                        extend: 'csv', // Botón para exportar datos en formato CSV
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Especifica qué columnas se exportarán
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] 
                        }
                    }
                ],
            });

            // Llama a la función que inicia el escáner de códigos QR
            startScanner();

            // Obtiene los parámetros de la URL para mostrar mensajes
            const urlParams = new URLSearchParams(window.location.search);
            const mensaje = urlParams.get('mensaje');
            const tipo = urlParams.get('tipo') || 'success';

            // Muestra una alerta en base en el mensaje y tipo obtenido de la URL
            if (mensaje) {
                if (tipo === 'warning') {
                    Swal.fire({
                        icon: 'warning',
                        title: mensaje,
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        icon: tipo, // Tipo de alerta: éxito o error basado en 'tipo'
                        title: mensaje, // Mensaje a mostrar
                        toast: true,
                        position: 'top-end', 
                        showConfirmButton: false,
                        timer: 500, 
                        timerProgressBar: false
                    });
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</main>
