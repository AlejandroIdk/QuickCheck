<?php

// Inicio para la paginación
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

// Definición de los campos para la consulta SQL
$campos = "usuario_clase.userclass_id, usuario_clase.usuario_identificacion, clases.clase_nombre";

// Construcción de consultas SQL basadas en condiciones
if (isset($busqueda) && $busqueda != "") {
    // Consulta cuando hay término de búsqueda
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

    foreach ($datos as $row) {
        $tabla .= '<tr class="has-text-centered">
            <td>' . $contador . '</td>
            <td>' . $row['usuario_identificacion'] . '</td>
            <td>' . $row['clase_nombre'] . '</td>
            <td>
                <a href="index.php?vista=user_class_update&userclass_id=' . $row['userclass_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
            </td>
            <td>
                <a href="' . $url . '&pagina=' . $pagina . '&userclass_id=' . $row['userclass_id'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
            </td>
        </tr>';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    // Mostrar mensaje cuando no hay registros
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
