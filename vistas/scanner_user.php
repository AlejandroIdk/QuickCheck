<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaneo QR de Asistencia</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Escanea tu código QR</h5>
                    <video id="interactive" class="viewport w-100"></video>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Estudiantes Marcados</h5>
                    <div id="attendance-table" class="table-responsive">
                        <?php
                        include('./php/main.php');
                        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
                        $registros = 15; // Valor de ejemplo, ajusta según tus necesidades
                        $url = $_SERVER['PHP_SELF'] . "?";

                        // Definición de variables
                        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
                        $tabla = "";

                        // Conexión a la base de datos
                        $conexion = conexion();

                        // Consultas SQL para obtener datos y total de registros
                        if (isset($busqueda) && $busqueda != "") {
                            $consulta_datos = "SELECT a.asistencia_id, u.usuario_identificacion, c.clase_nombre, a.fecha 
                                               FROM asistencia a
                                               INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                                               INNER JOIN clases c ON a.clase_id = c.clase_id
                                               WHERE u.usuario_nombre LIKE '%$busqueda%' 
                                               ORDER BY a.fecha ASC 
                                               LIMIT $inicio, $registros";

                            $consulta_total = "SELECT COUNT(a.asistencia_id) AS total 
                                               FROM asistencia a
                                               INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                                               INNER JOIN clases c ON a.clase_id = c.clase_id
                                               WHERE u.usuario_nombre LIKE '%$busqueda%'";
                        } else {
                            $consulta_datos = "SELECT a.asistencia_id, u.usuario_identificacion, c.clase_nombre, a.fecha 
                                               FROM asistencia a
                                               INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                                               INNER JOIN clases c ON a.clase_id = c.clase_id
                                               ORDER BY a.fecha ASC 
                                               LIMIT $inicio, $registros";

                            $consulta_total = "SELECT COUNT(a.asistencia_id) AS total 
                                               FROM asistencia a
                                               INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                                               INNER JOIN clases c ON a.clase_id = c.clase_id";
                        }

                        // Ejecutar consulta para obtener datos
                        $stmt_datos = $conexion->query($consulta_datos);
                        $datos = $stmt_datos->fetchAll();

                        // Obtener total de registros
                        $stmt_total = $conexion->query($consulta_total);
                        $total = (int) $stmt_total->fetchColumn();

                        // Calcular número de páginas
                        $Npaginas = ceil($total / $registros);

                        // Construcción de la tabla HTML
                        $tabla .= '
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Identificación</th>
                                    <th>Clase</th>
                                    <th>Fecha</th>
                                    <th colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';

                        // Verificar si hay datos para mostrar
                        if ($total >= 1 && $pagina <= $Npaginas) {
                            $contador = $inicio + 1;
                            $pag_inicio = $inicio + 1;

                            // Iterar sobre los datos obtenidos
                            foreach ($datos as $row) {
                                $tabla .= '
                                <tr class="text-center">
                                    <td>' . $contador . '</td>
                                    <td>' . $row['usuario_identificacion'] . '</td>
                                    <td>' . $row['clase_nombre'] . '</td>
                                    <td>' . $row['fecha'] . '</td>
                                    <td>
                                        <a href="index.php?vista=attendance_update&attendance_id_up=' . $row['asistencia_id'] . '" class="btn btn-success btn-sm">Actualizar</a>
                                    </td>
                                    <td>
                                        <button onclick="deleteAttendance(' . $row['asistencia_id'] . ')" class="btn btn-danger btn-sm">Eliminar</button>
                                    </td>
                                </tr>
                                ';
                                $contador++;
                            }
                            $pag_final = $contador - 1;
                        } else {
                            // Manejo cuando no hay datos o hay un error en la paginación
                            $tabla .= '
                                <tr class="text-center">
                                    <td colspan="5">No hay registros para mostrar</td>
                                </tr>
                            ';
                        }

                        $tabla .= '</tbody></table>';

                        // Mostrar información sobre la paginación si hay registros
                        if ($total > 0 && $pagina <= $Npaginas) {
                            $tabla .= '<p class="text-right">Mostrando registros <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un total de <strong>' . $total . '</strong></p>';
                        }

                        // Cerrar conexión a la base de datos
                        $conexion = null;

                        // Imprimir la tabla y el paginador si hay datos para mostrar
                        echo $tabla;

                        if ($total >= 1 && $pagina <= $Npaginas) {
                            echo paginador_tablas($pagina, $Npaginas, $url, 7); // Suponiendo que `paginador_tablas()` está definido en otro lugar
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenedor para la alerta -->
<div class="alert-container"></div>

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
        scanner = new Instascan.Scanner({
            video: document.getElementById('interactive')
        });

        scanner.addListener('scan', function(content) {
            $("#detected-qr-code").val(content);
            console.log(content);
            scanner.stop();

            document.querySelector(".qr-detected-container").style.display = '';
            document.querySelector(".card-body").style.display = 'none';

            // Automáticamente enviar el formulario
            document.getElementById('attendanceForm').submit();

            // Mostrar alerta de éxito en el área de escaneo
            showAlert('Código QR leído exitosamente!');

            // Reiniciar el escáner para poder leer otro código QR
            setTimeout(function() {
                document.querySelector(".qr-detected-container").style.display = 'none';
                document.querySelector(".card-body").style.display = '';
                scanner.start();
            }, 3000); // Reiniciar después de 3 segundos (ajustable según necesidad)
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

    function showAlert(message) {
        // Bootstrap alert
        const alert = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>`;

        // Insertar la alerta dentro del contenedor de alertas
        document.querySelector('.alert-container').innerHTML = alert;
    }

    document.addEventListener('DOMContentLoaded', startScanner);

    function deleteAttendance(id) {
        if (confirm("¿Seguro que deseas eliminar esta asistencia?")) {
            window.location = "./endpoint/delete-attendance.php?attendance=" + id;
        }
    }

    // Función para manejar el envío del formulario de asistencia
    $('#attendanceForm').on('submit', function(event) {
        event.preventDefault(); // Evitar el envío estándar del formulario
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // Obtener la URL del atributo action del formulario
            data: $(this).serialize(), // Serializar los datos del formulario para enviarlos
            success: function(response) {
                // Actualizar la tabla con los nuevos datos
                $('#attendance-table').load(location.href + ' #attendance-table');
                // Mostrar alerta de éxito
                showAlert('Asistencia registrada exitosamente!');
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX: ' + error);
                showAlert('Error al registrar la asistencia.');
            }
        });
    });
</script>
</body>
</html>
