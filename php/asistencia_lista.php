<?php
    // Definición de variables (asegúrate de que estas variables estén definidas previamente)
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $tabla = "";

    // Conexión a la base de datos (asegúrate de que `conexion()` esté definida correctamente)
    $conexion = conexion();

    // Consultas SQL para obtener los datos y el total de registros
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

    // Ejecutar la consulta para obtener los datos
    $stmt_datos = $conexion->query($consulta_datos);
    $datos = $stmt_datos->fetchAll();

    // Obtener el total de registros
    $stmt_total = $conexion->query($consulta_total);
    $total = (int) $stmt_total->fetchColumn();

    // Calcular el número de páginas
    $Npaginas = ceil($total / $registros);

    // Construcción de la tabla HTML
    $tabla .= '
        <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr class="has-text-centered">
                        <th>#</th>
                        <th>Identificación Usuario</th>
                        <th>Clase</th>
                        <th>Fecha de Asistencia</th>
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
                <tr class="has-text-centered">
                    <td>' . $contador . '</td>
                    <td>' . $row['usuario_identificacion'] . '</td>
                    <td>' . $row['clase_nombre'] . '</td>
                    <td>' . $row['fecha'] . '</td>
                    <td>
                        <a href="index.php?vista=attendance_update&attendance_id_up=' . $row['asistencia_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="' . $url . $pagina . '&attendance_id_del=' . $row['asistencia_id'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
                </tr>
            ';
            $contador++;
        }
        $pag_final = $contador - 1;
    } else {
        // Manejo cuando no hay datos o hay un error en la paginación
        $tabla .= '
            <tr class="has-text-centered">
                <td colspan="5">No hay registros para mostrar</td>
            </tr>
        ';
    }

    $tabla .= '</tbody></table></div>';

    // Mostrar información sobre la paginación si hay registros
    if ($total > 0 && $pagina <= $Npaginas) {
        $tabla .= '<p class="has-text-right">Mostrando registros <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un total de <strong>' . $total . '</strong></p>';
    }

    // Cerrar la conexión a la base de datos
    $conexion = null;

    // Imprimir la tabla y el paginador si hay datos para mostrar
    echo $tabla;

    if ($total >= 1 && $pagina <= $Npaginas) {
        echo paginador_tablas($pagina, $Npaginas, $url, 7); // Suponiendo que `paginador_tablas()` está definido en otro lugar
    }
?>
