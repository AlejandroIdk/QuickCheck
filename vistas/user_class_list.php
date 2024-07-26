<?php
require_once "./php/main.php";

if (isset($_GET['userclass_id_del'])) {
    require_once "./php/usuario_clase_eliminar.php";
}

$clase_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
$conexion = conexion();

$consulta = $conexion->query("SELECT u.usuario_identificacion, u.usuario_nombre, u.usuario_apellido, 
                                      c.clase_nombre, c.clase_ubicacion, uc.userclass_id 
                               FROM usuario_clase uc
                               INNER JOIN usuario u ON uc.usuario_identificacion = u.usuario_identificacion
                               INNER JOIN clases c ON uc.clase_id = c.clase_id");
$usuario_clase = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_new">Crear Clase</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_list">Lista de Clases</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_search">Buscar Usuario</a></li>
            </ol>
        </nav>
    </div>

    <?php
    include "./inc/btn_back.php";
    ?>

    <div class="container is-fluid">
        <h1 class="title">Usuarios</h1>
        <h2 class="subtitle">Lista de Usuarios</h2>
    </div>

    <div class="container pb-6 pt-2">
        <div class="table-responsive">
            <table id="tablaASistencia" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Clase</th>
                        <th>Salón</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuario_clase as $userclass) : ?>
                        <tr>
                            <td><?php echo $userclass['usuario_identificacion']; ?></td>
                            <td><?php echo $userclass['clase_nombre']; ?></td>
                            <td><?php echo $userclass['clase_ubicacion']; ?></td>
                            <td><?php echo $userclass['usuario_nombre']; ?></td>
                            <td><?php echo $userclass['usuario_apellido']; ?></td>
                            <td>
                                <a href="index.php?vista=user_class_update&userclass_id_up=<?php echo $userclass['userclass_id']; ?>" title="Editar">
                                    <i class="fas fa-edit" style="color: green;"></i>
                                </a>
                                |
                                <a href="index.php?vista=usuario_clase_eliminar&userclass_id_del=<?php echo $userclass['userclass_id']; ?>" title="Eliminar">
                                    <i class="fas fa-trash-alt" style="color: red;"></i>
                                </a>
                            </td>
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
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ],
            // language: {
            //     url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json'
            // }
        });
    });
</script>