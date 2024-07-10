<?php

// Conexion a la base de datos 
function conexion()
{
    $pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', '');
    return $pdo;
}

// Verificar datos 
function verificar_datos($filtro, $cadena)
{
    if (preg_match("/^" . $filtro . "$/", $cadena)) {
        return false;
    } else {
        return true;
    }
}

// Limpiar cadenas de texto
function limpiar_cadena($cadena)
{
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("?>", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("<", "", $cadena);
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);
    $cadena = str_ireplace("::", "", $cadena);
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    return $cadena;
}

// Funcion paginador de tablas
function paginador_tablas($pagina, $Npaginas, $url, $botones)
{
    $tabla = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

    if ($pagina <= 1) {
        $tabla .= '
        <a class="pagination-previous is-disabled" disabled >Anterior</a>
        <ul class="pagination-list">';
    } else {
        $tabla .= '
        <a class="pagination-previous" href="' . $url . ($pagina - 1) . '" >Anterior</a>
        <ul class="pagination-list">
            <li><a class="pagination-link" href="' . $url . '1">1</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
        ';
    }

    $ci = 0;
    for ($i = $pagina; $i <= $Npaginas; $i++) {
        if ($ci >= $botones) {
            break;
        }
        if ($pagina == $i) {
            $tabla .= '<li><a class="pagination-link is-current" href="' . $url . $i . '">' . $i . '</a></li>';
        } else {
            $tabla .= '<li><a class="pagination-link" href="' . $url . $i . '">' . $i . '</a></li>';
        }
        $ci++;
    }

    if ($pagina == $Npaginas) {
        $tabla .= '
        </ul>
        <a class="pagination-next is-disabled" disabled >Siguiente</a>
        ';
    } else {
        $tabla .= '
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link" href="' . $url . $Npaginas . '">' . $Npaginas . '</a></li>
        </ul>
        <a class="pagination-next" href="' . $url . ($pagina + 1) . '" >Siguiente</a>
        ';
    }

    $tabla .= '</nav>';
    return $tabla;
}
// // // // Uso de las funciones en el código

// // // // Aquí puedes utilizar las funciones en tu aplicación 

// // // // Ejemplo de uso de conexión:
// // // // $pdo = conexion();
// // // // Aquí puedes realizar consultas usando $pdo

// // // // Ejemplo de uso de limpiar_cadena:
// // // // $cadena = '<script>alert("Hola");</script>';
// // // // $cadena_limpia = limpiar_cadena($cadena);

// // // // Ejemplo de uso de verificar_datos:
// // // // $filtro = "[a-zA-Z0-9$@.-]{7,100}";
// // // // $cadena_verificar = "ejemplo123$@";
// // // // $resultado = verificar_datos($filtro, $cadena_verificar);

// // // // Ejemplo de uso de paginador_tablas:
// // // // $pagina_actual = 1;
// // // // $total_paginas = 10;
// // // // $url_base = "listado.php?page=";
// // // // $num_botones = 5;
// // // // $paginador = paginador_tablas($pagina_actual, $total_paginas, $url_base, $num_botones);

// // // // echo $paginador; // Aquí se mostrará el paginador generado
