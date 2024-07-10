<?php

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$campos = "usuario_clase.userclass_id, usuario_clase.usuario_identificacion, clases.clase_nombre";

if (isset($busqueda) && $busqueda != "") {

    $consulta_datos = "SELECT $campos FROM usuario_clase
    INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id
    WHERE usuario_clase.usuario_identificacion LIKE '%$busqueda%'
    OR clases.clase_nombre LIKE '%$busqueda%'
    ORDER BY usuario_clase.usuario_identificacion ASC LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(userclass_id) 
    FROM usuario_clase 
    INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id
    WHERE usuario_clase.usuario_identificacion LIKE '%$busqueda%'
    OR clases.clase_nombre LIKE '%$busqueda%'";
} elseif ($clase_id > 0) {

    $consulta_datos = "SELECT $campos
    FROM usuario_clase INNER JOIN clases 
    ON usuario_clase.clase_id = clases.clase_id 
    WHERE usuario_clase.clase_id = '$clase_id' 
    ORDER BY usuario_clase.usuario_identificacion ASC LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(userclass_id) 
    FROM usuario_clase 
    WHERE clase_id = '$clase_id'";
} else {

    $consulta_datos = "SELECT $campos 
    FROM usuario_clase 
    INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id 
    ORDER BY usuario_clase.usuario_identificacion ASC LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(userclass_id) FROM usuario_clase";
}

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas = ceil($total / $registros);

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

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;

    foreach ($datos as $row) {
        $tabla .= '<tr class="has-text-centered">
            <td>' . $contador . '</td>
            <td>' . $row['usuario_identificacion'] . '</td>
            <td>' . $row['clase_nombre'] . '</td>
            <td>
                <a href="index.php?vista=user_class_update&userclass_id_up=' . $row['userclass_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
            </td>
            <td>
                <a href="' . $url . '&pagina=' . $pagina . '&userclass_id_del=' . $row['userclass_id'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
            </td>
        </tr>';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {

    if ($total >= 1) {
        $tabla .= '<tr class="has-text-centered">
                <td colspan="5">
                    <a href="' . $url . '&pagina=1" class="button is-link is-rounded is-small mt-4 mb-4">Haga clic aquí para recargar el listado</a>
                </td>
            </tr>';
    } else {
        $tabla .= '<tr class="has-text-centered">
                <td colspan="5">No hay registros en el sistema</td>
            </tr>';
    }
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando usuarios <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null;

echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
