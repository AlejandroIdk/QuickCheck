<?php
require_once "./php/main.php";

if (isset($_GET['rol_code_del'])) {
    require_once "./php/rol_eliminar.php";
}

$conexion = conexion();

$consulta = $conexion->query("SELECT rol_code, rol_nombre FROM roles");
$roles = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=rol_new">Crear Rol</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=rol_list">Lista de Roles</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=rol_search">Buscar Rol</a></li>
            </ol>
        </nav>
    </div>
    <?php
        include "./inc/btn_back.php";
    ?>


    <div class="container is-fluid">
        <h1 class="title">Roles</h1>
        <h2 class="subtitle">Lista de Roles</h2>
    </div>

    <div class="container pb-6 pt-4">
        <div class="table-responsive">
            <table id="tablaRoles" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $rol) : ?>
                        <tr>
                            <td><?php echo $rol['rol_code']; ?></td>
                            <td><?php echo $rol['rol_nombre']; ?></td>
                            <td>
                                <a href="index.php?vista=rol_update&rol_code_up=<?php echo $rol['rol_code']; ?>" title="Editar">
                                    <i class="fas fa-edit" style="color: green;"></i>
                                </a>
                                |
                                <a href="index.php?vista=rol_eliminar&rol_code_del=<?php echo $rol['rol_code']; ?>" title="Eliminar">
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
        $('#tablaRoles').DataTable({
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
            ],
            // language: {
            //     url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' // Idioma en español
            // }
        });
    });
</script>
<!-- porque no elimina que debe ir en el archivo eliminar -->