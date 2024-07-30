<?php
require_once "./php/main.php";

if (isset($_GET['clase_id_del'])) {
    require_once "./php/clase_eliminar.php";
}

$conexion = conexion();

$consulta = $conexion->query("SELECT * FROM clases");
$usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=class_new">Crear Clase</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=class_list">Lista de Clases</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=class_search">Buscar Clase</a></li>
            </ol>
        </nav>
    </div>
    <?php
        include "./inc/btn_back.php";
    ?>

    <div class="container is-fluid">
        <h1 class="title">Clases</h1>
        <h2 class="subtitle">Lista de Clases</h2>
    </div>

    <div class="container pb-6 pt-4">
        <div class="table-responsive">
            <table id="tablaUsuario" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Clase</th>
                        <th>Salón</th>
                        <th>Ver estudiantes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuario as $user) : ?>
                        <tr>
                            <td><?php echo $user['clase_nombre']; ?></td>
                            <td><?php echo $user['clase_ubicacion']; ?></td>
                            <td>
                                <a href="index.php?vista=user_class_category&category_id=<?php echo $user['clase_id']; ?>" title="Ver estudiantes">
                                    <i class="fas fa-edit" style="color: green;"></i>
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
        $('#tablaUsuario').DataTable({
            responsive: true,
            dom: 'Bfrtip', // Para agregar los botones al final de la tabla
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1]
                    }
                }
            ]
        });
    });
</script>
