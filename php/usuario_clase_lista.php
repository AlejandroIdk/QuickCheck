como hago para que esto

<?php

// Inicio para la paginación
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

// Definine los campos para la consulta SQL
$campos = "usuario_clase.userclass_id, usuario_clase.usuario_identificacion, clases.clase_nombre";

// Construcción de consultas SQL basadas en condiciones
if (isset($busqueda) && $busqueda != "") {
    // Consulta cuando hay término de búsqueda
    $consulta_datos = "SELECT $campos FROM usuario_clase
    INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id
    WHERE usuario_clase.usuario_clase_codigo LIKE '%$busqueda%'
    OR usuario_clase.usuario_clase_nombre LIKE '%$busqueda%'
    ORDER BY usuario_clase.usuario_identificacion ASC LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(userclass_id) 
    FROM usuario_clase 
    WHERE usuario_clase_codigo LIKE '%$busqueda%' 
    OR usuario_clase_nombre LIKE '%$busqueda%'";

} elseif ($clase_id > 0) {
    // Consulta cuando se filtra por ID de clase
    $consulta_datos = "SELECT $campos
    FROM usuario_clase INNER JOIN clases 
    ON usuario_clase.clase_id = clases.clase_id 
    WHERE usuario_clase.clase_id = '$clase_id' 
    ORDER BY usuario_clase.usuario_identificacion ASC LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(userclass_id) 
    FROM usuario_clase 
    WHERE clase_id = '$clase_id'";
    
} else {
    // Consulta general sin filtros específicos
    $consulta_datos = "SELECT $campos 
    FROM usuario_clase 
    INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id 
    ORDER BY usuario_clase.usuario_identificacion ASC LIMIT $inicio, $registros";


    $consulta_total = "SELECT COUNT(userclass_id) FROM usuario_clase";
}

// Establecer conexión a la base de datos
$conexion = conexion();

// Ejecutar consulta para obtener los datos paginados
$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

// Obtener el total de registros para la paginación
$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

// Calcular el número de páginas para la paginación
$Npaginas = ceil($total / $registros);

// Construir la tabla HTML para mostrar los datos
$tabla .= '<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>ID Estudiante</th>
                <th>Salón</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>';

// Llenar la tabla con los datos obtenidos
if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;

    foreach ($datos as $rows) {
        $tabla .= '<tr class="has-text-centered">
            <td>' . $contador . '</td>
            <td>' . $rows['usuario_identificacion'] . '</td>
            <td>' . $rows['clase_nombre'] . '</td>
            <td>
                <a href="index.php?vista=user_class_update&product_id_up=' . $rows['userclass_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
            </td>
            <td>
                <a href="' . $url . $pagina . '&product_id_del=' . $rows['userclass_id'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
            </td>
        </tr>';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    // Mostrar mensaje cuando no hay registros
    if ($total >= 1) {
        $tabla .= '<tr class="has-text-centered">
                <td colspan="7">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">Haga clic acá para recargar el listado</a>
                </td>
            </tr>';
    } else {
        $tabla .= '<tr class="has-text-centered">
                <td colspan="7">No hay registros en el sistema</td>
            </tr>';
    }
}

// Cerrar la tabla HTML
$tabla .= '</tbody></table></div>';

// Mostrar información de paginación si hay datos y páginas disponibles
if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando usuarios <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

// Cerrar conexión a la base de datos
$conexion = null;

// Mostrar la tabla HTML generada
echo $tabla;

// Mostrar el paginador si hay datos y páginas disponibles
if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}

?>

muestre codigo como aqui


<div class="main">
        
        <div class="student-container">
            <div class="student-list">
                <div class="title">
                    <h4>List of Students</h4>
                    <button class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal">Add Student</button>
                </div>
                <hr>
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="studentTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Course & Section</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                include ('./conn/conn.php');

                                $stmt = $conn->prepare("SELECT * FROM tbl_student");
                                $stmt->execute();
                
                                $result = $stmt->fetchAll();
                
                                foreach ($result as $row) {
                                    $studentID = $row["tbl_student_id"];
                                    $studentName = $row["student_name"];
                                    $studentCourse = $row["course_section"];
                                    $qrCode = $row["generated_code"];
                                ?>

                                <tr>
                                    <th scope="row" id="studentID-<?= $studentID ?>"><?= $studentID ?></th>
                                    <td id="studentName-<?= $studentID ?>"><?= $studentName ?></td>
                                    <td id="studentCourse-<?= $studentID ?>"><?= $studentCourse ?></td>
                                    <td>
                                        <div class="action-button">
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#qrCodeModal<?= $studentID ?>"><img src="https://cdn-icons-png.flaticon.com/512/1341/1341632.png" alt="" width="16"></button>

                                            <!-- QR Modal -->
                                            <div class="modal fade" id="qrCodeModal<?= $studentID ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?= $studentName ?>'s QR Code</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $qrCode ?>" alt="" width="300">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-secondary btn-sm" onclick="updateStudent(<?= $studentID ?>)">&#128393;</button>
                                            <button class="btn btn-danger btn-sm" onclick="deleteStudent(<?= $studentID ?>)">&#10006;</button>
                                        </div>
                                    </td>
                                </tr>

                                <?php
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

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#studentTable').DataTable();
        });

        function updateStudent(id) {
            $("#updateStudentModal").modal("show");

            let updateStudentId = $("#studentID-" + id).text();
            let updateStudentName = $("#studentName-" + id).text();
            let updateStudentCourse = $("#studentCourse-" + id).text();

            $("#updateStudentId").val(updateStudentId);
            $("#updateStudentName").val(updateStudentName);
            $("#updateStudentCourse").val(updateStudentCourse);
        }

        function deleteStudent(id) {
            if (confirm("Do you want to delete this student?")) {
                window.location = "./endpoint/delete-student.php?student=" + id;
            }
        }

        function generateRandomCode(length) {
            const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            let randomString = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                randomString += characters.charAt(randomIndex);
            }

            return randomString;
        }

        function generateQrCode() {
            const qrImg = document.getElementById('qrImg');

            let text = generateRandomCode(10);
            $("#generatedCode").val(text);

            if (text === "") {
                alert("Please enter text to generate a QR code.");
                return;
            } else {
                const apiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;

                qrImg.src = apiUrl;
                document.getElementById('studentName').style.pointerEvents = 'none';
                document.getElementById('studentCourse').style.pointerEvents = 'none';
                document.querySelector('.modal-close').style.display = '';
                document.querySelector('.qr-con').style.display = '';
                document.querySelector('.qr-generator').style.display = 'none';
            }
        }
    </script>
    
</body>
</html>

que es lo que hacer ver el codigo, hazmelo pero con lo que te di de primero