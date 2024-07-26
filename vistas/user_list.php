<?php
require_once "./php/main.php";

if (isset($_GET['user_id_del'])) {
    require_once "./php/usuario_eliminar.php";
}

$conexion = conexion();

$consulta = $conexion->query("SELECT usuario.*, roles.rol_nombre FROM usuario JOIN roles ON usuario.rol_code = roles.rol_code ");
$usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=user_new">Crear Usuario</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_list">Lista de Usuarios</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_search">Buscar Usuario</a></li>
            </ol>
        </nav>
    </div>
    <?php
        include "./inc/btn_back.php";
    ?>

    <div class="container is-fluid mt-3">
        <h1 class="title">Usuarios</h1>
        <h2 class="subtitle">Lista de Usuarios</h2>
    </div>

    <div class="container pb-6 pt-4">
        <div class="table-responsive">
            <table id="tablaUsuario" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Rol</th>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Apellido</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuario as $user) : ?>
                        <tr>
                            <td><?php echo $user['rol_nombre']; ?></td>
                            <td><?php echo $user['usuario_identificacion']; ?></td>
                            <td><?php echo $user['usuario_nombre']; ?></td>
                            <td><?php echo $user['usuario_apellido']; ?></td>
                            <td><?php echo $user['usuario_email']; ?></td>

                            <td>
                                <a href="index.php?vista=user_update&user_id_up=<?php echo $user['rol_code']; ?>" title="Editar">
                                    <i class="fas fa-edit" style="color: green;"></i>
                                </a>
                                |
                                <a href="index.php?vista=rol_eliminar&rol_code_del=<?php echo $user['rol_code']; ?>" title="Eliminar">
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
        $('#tablaUsuario').DataTable({
            responsive: true,
            dom: 'Bfrtip', // Para agregar los botones al final de la tabla
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
            //     url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' // Idioma en español
            // }
        });
        
    });
</script>

