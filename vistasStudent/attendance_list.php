<?php
require_once "./php/main.php";

if (isset($_GET['asistencia_id_del'])) {
    require_once "./php/asistencia_eliminar.php";
}

$conexion = conexion();

$consulta = $conexion->query("SELECT a.asistencia_id, u.usuario_identificacion, u.usuario_nombre, u.usuario_apellido, c.clase_nombre, c.clase_ubicacion, a.fecha 
                           FROM asistencia a
                           INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                           INNER JOIN clases c ON a.clase_id = c.clase_id");
$asistencia = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="main" class="main">
 
    <?php
    include "./inc/btn_back.php";
    ?>

    <div class="container is-fluid mt-3">
        <h1 class="title">Usuarios</h1>
        <h2 class="subtitle">Lista de Usuarios</h2>
    </div>

    <div class="container pb-6 pt-4">
        <div class="table-responsive">
            <table id="tablaASistencia" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Clase</th>
                        <th>Salón</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha</th>
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
                          
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#tablaASistencia').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
            // language: {
            //     url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json'
            // }
        });
    });
</script>