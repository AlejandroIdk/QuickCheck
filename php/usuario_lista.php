<?php
    // Inicio para la consulta SQL basado en la página y número de registros por página
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $tabla = "";

    // Comprobación de existencia y contenido de la variable $busqueda para ajustar la consulta SQL
    if (isset($busqueda) && $busqueda != "") {
        // Consulta SQL para obtener los datos filtrados según la búsqueda
        $consulta_datos = "
            SELECT usuario.*, roles.rol_nombre 
            FROM usuario 
            JOIN roles ON usuario.rol_code = roles.rol_code 
            WHERE usuario.usuario_identificacion LIKE '%$busqueda%' 
                OR usuario.usuario_nombre LIKE '%$busqueda%' 
                OR usuario.usuario_apellido LIKE '%$busqueda%' 
                OR usuario.usuario_email LIKE '%$busqueda%' 
                OR usuario.rol_code LIKE '%$busqueda%' 
            ORDER BY roles.rol_nombre ASC, usuario.usuario_nombre ASC 
            LIMIT $inicio, $registros";

        // Consulta SQL para obtener el total de registros coincidentes con la búsqueda
        $consulta_total = "
            SELECT COUNT(usuario.usuario_identificacion) 
            FROM usuario 
            JOIN roles ON usuario.rol_code = roles.rol_code 
            WHERE usuario.usuario_nombre LIKE '%$busqueda%' 
                OR usuario.usuario_apellido LIKE '%$busqueda%' 
                OR usuario.usuario_identificacion LIKE '%$busqueda%' 
                OR usuario.usuario_email LIKE '%$busqueda%' 
                OR usuario.rol_code LIKE '%$busqueda%'";
    } else {
        // Consulta SQL para obtener todos los datos si no hay filtro de búsqueda
        $consulta_datos = "
            SELECT usuario.*, roles.rol_nombre 
            FROM usuario 
            JOIN roles ON usuario.rol_code = roles.rol_code 
            ORDER BY roles.rol_nombre ASC, usuario.usuario_nombre ASC 
            LIMIT $inicio, $registros";

        // Consulta SQL para obtener el total de registros en la tabla usuario
        $consulta_total = "SELECT COUNT(usuario_identificacion) FROM usuario";
    }

    // Establecimiento de conexión y ejecución de las consultas SQL
    $conexion = conexion();

    // Obtención de los datos según la consulta de datos
    $datos = $conexion->query($consulta_datos);
    $datos = $datos->fetchAll();

    // Obtención del total de registros según la consulta de total
    $total = $conexion->query($consulta_total);
    $total = (int) $total->fetchColumn();

    // Número total de páginas para la paginación
    $Npaginas = ceil($total / $registros);

    // Construcción de la tabla HTML para mostrar los datos
    $tabla .= '
    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>ROL</th>
                    <th>Usuario ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
    ';

    // Si hay datos que mostrar y la página solicitada es válida
    if ($total >= 1 && $pagina <= $Npaginas) {
        $contador = $inicio + 1;
        $pag_inicio = $inicio + 1;

        // Datos obtenidos para construir filas de la tabla
        foreach ($datos as $rows) {
            $tabla .= '
                <tr class="has-text-centered">
                    <td>' . $contador . '</td>
                    <td>' . $rows['rol_nombre'] . '</td>
                    <td>' . $rows['usuario_identificacion'] . '</td>
                    <td>' . $rows['usuario_nombre'] . '</td>
                    <td>' . $rows['usuario_apellido'] . '</td>
                    <td>' . $rows['usuario_email'] . '</td>
                    <td>
                        <a href="index.php?vista=user_update&user_id_up=' . $rows['usuario_identificacion'] . '" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="' . $url . $pagina . '&user_id_del=' . $rows['usuario_identificacion'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
                </tr>
            ';
            $contador++;
        }
        $pag_final = $contador - 1;
    } else {
        // Si no hay datos que mostrar, se muestra un mensaje indicando la falta de registros
        if ($total >= 1) {
            $tabla .= '
                <tr class="has-text-centered">
                    <td colspan="7">
                        <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>
            ';
        } else {
            $tabla .= '
                <tr class="has-text-centered">
                    <td colspan="7">
                        No hay registros en el sistema
                    </td>
                </tr>
            ';
        }
    }

    // Cierre de la tabla HTML
    $tabla .= '</tbody></table></div>';

    // Si hay datos y la página solicitada es válida, se muestra la información de paginación
    if ($total > 0 && $pagina <= $Npaginas) {
        $tabla .= '<p class="has-text-right">Mostrando usuarios <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
    }

    // Cierre de la conexión a la base de datos
    $conexion = null;

    // Impresión de la tabla HTML
    echo $tabla;

    // Si hay datos y la página solicitada es válida, se genera el paginador
    if ($total >= 1 && $pagina <= $Npaginas) {
        echo paginador_tablas($pagina, $Npaginas, $url, 7);
    }
?>
