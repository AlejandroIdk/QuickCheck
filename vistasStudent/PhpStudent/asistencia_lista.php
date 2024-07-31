<?php

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$conexion = conexion();

if (isset($busqueda) && $busqueda != "") {
    $consulta_datos = "SELECT a.asistencia_id, u.usuario_identificacion, c.clase_nombre, a.fecha 
                           FROM asistencia a
                           INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                           INNER JOIN clases c ON a.clase_id = c.clase_id
                           WHERE u.usuario_nombre LIKE '%$busqueda%' 
                           ORDER BY a.fecha DESC 
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
                           ORDER BY a.fecha DESC 
                           LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(a.asistencia_id) AS total 
                           FROM asistencia a
                           INNER JOIN usuario u ON a.usuario_identificacion = u.usuario_identificacion
                           INNER JOIN clases c ON a.clase_id = c.clase_id";
}

$stmt_datos = $conexion->query($consulta_datos);
$datos = $stmt_datos->fetchAll();

$stmt_total = $conexion->query($consulta_total);
$total = (int) $stmt_total->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
        <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr class="has-text-centered">
                        <th>#</th>
                        <th>Identificación Usuario</th>
                        <th>Clase</th>
                        <th>Fecha de Asistencia</th>
                    </tr>
                </thead>
                <tbody>
    ';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;

    foreach ($datos as $row) {
        $tabla .= '
                <tr class="has-text-centered">
                    <td>' . $contador . '</td>
                    <td>' . $row['usuario_identificacion'] . '</td>
                    <td>' . $row['clase_nombre'] . '</td>
                    <td>' . $row['fecha'] . '</td>
                 
                </tr>
            ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {

    $tabla .= '
            <tr class="has-text-centered">
                <td colspan="5">No hay registros para mostrar</td>
            </tr>
        ';
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando registros <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un total de <strong>' . $total . '</strong></p>';
}

$conexion = null;

echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
