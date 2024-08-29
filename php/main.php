<?php

// Conexion a la base de datos 
function conexion()
{
    $hostname = "dbpruebaserver.mysql.database.azure.com";
    $port = "3306";
    $database = "pdo";
    $username = "adminprueba";
    $password = "Prueba@123";
    $options = array(
        PDO::MYSQL_ATTR_SSL_CA => 'assets/DigiCertGlobalRootCA.crt.pem'
    );
    $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8",$username,$password,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;

    //  $pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', '');
    // // $pdo = new PDO('mysql:host=mydemoserver.mysql.database.azure.com;port=3306;dbname=databasename', 'myadmin', 'yourpassword');
    //  return $pdo;
}

// Verificar datos 
function verificar_datos($filtro, $cadena)
{
    // función preg_match para verificar si la cadena cumple con el filtro dado
    if (preg_match("/^" . $filtro . "$/", $cadena)) {
        // Si la cadena cumple con el filtro (es decir, hay una coincidencia), retorna false
        return false;
    } else {
        // Si la cadena no cumple con el filtro, retorna true
        return true;
    }
}


// Limpiar cadenas de texto
function limpiar_cadena($cadena)
{
    // Elimina espacios en blanco al principio y al final de la cadena
    $cadena = trim($cadena);

    // Elimina barras invertidas adicionales de la cadena (generalmente usadas para escapar caracteres)
    $cadena = stripslashes($cadena);

    // Elimina etiquetas <script> y sus variantes de la cadena
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);

    // Elimina comandos SQL potencialmente peligrosos de la cadena
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASES;", "", $cadena);

    // Elimina etiquetas PHP de la cadena
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("?>", "", $cadena);

    // Elimina el comentario SQL de doble guion (--)
    $cadena = str_ireplace("--", "", $cadena);

    // Elimina el símbolo ^ de la cadena
    $cadena = str_ireplace("^", "", $cadena);

    // Elimina el símbolo < de la cadena
    $cadena = str_ireplace("<", "", $cadena);

    // Elimina los corchetes [ y ]
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);

    // Elimina el operador de igualdad doble (==) y el punto y coma (;) de la cadena
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);

    // Elimina el operador de resolución de ámbito (::) de la cadena
    $cadena = str_ireplace("::", "", $cadena);

    // Elimina espacios en blanco al principio y al final de la cadena (de nuevo por precaución)
    $cadena = trim($cadena);

    // Elimina barras invertidas adicionales (de nuevo por precaución)
    $cadena = stripslashes($cadena);

    // Retorna la cadena limpia y segura
    return $cadena;
}



// Funcion paginador de tablas
function paginador_tablas($pagina, $Npaginas, $url, $botones)
{
    // Inicia la estructura del componente de paginación con clases de Bulma CSS
    $tabla = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

    // Comprueba si la página actual es la primera
    if ($pagina <= 1) {
        // Si es la primera página, muestra el botón 'Anterior' deshabilitado y abre la lista de páginas
        $tabla .= '
        <a class="pagination-previous is-disabled" disabled >Anterior</a>
        <ul class="pagination-list">';
    } else {
        // Si no es la primera página, muestra el botón 'Anterior' con enlace y las primeras páginas numeradas
        $tabla .= '
        <a class="pagination-previous" href="' . $url . ($pagina - 1) . '" >Anterior</a>
        <ul class="pagination-list">
            <li><a class="pagination-link" href="' . $url . '1">1</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
        ';
    }

    // Contador para controlar la cantidad de botones de página a mostrar
    $ci = 0;

    // Ciclo para generar los botones de página numerados
    for ($i = $pagina; $i <= $Npaginas; $i++) {
        // Verifica si se han generado suficientes botones según el parámetro $botones
        if ($ci >= $botones) {
            break;
        }
        // Comprueba si el botón actual es la página activa
        if ($pagina == $i) {
            // Si es la página activa, muestra el enlace con la clase 'is-current'
            $tabla .= '<li><a class="pagination-link is-current" href="' . $url . $i . '">' . $i . '</a></li>';
        } else {
            // Si no es la página activa, muestra el enlace normal
            $tabla .= '<li><a class="pagination-link" href="' . $url . $i . '">' . $i . '</a></li>';
        }
        // Incrementa el contador de botones generados
        $ci++;
    }

    // Comprueba si la página actual es la última
    if ($pagina == $Npaginas) {
        // Si es la última página, cierra la lista de páginas y muestra el botón 'Siguiente' deshabilitado
        $tabla .= '
        </ul>
        <a class="pagination-next is-disabled" disabled >Siguiente</a>
        ';
    } else {
        // Si no es la última página, muestra el resto de páginas numeradas y el botón 'Siguiente' con enlace
        $tabla .= '
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link" href="' . $url . $Npaginas . '">' . $Npaginas . '</a></li>
        </ul>
        <a class="pagination-next" href="' . $url . ($pagina + 1) . '" >Siguiente</a>
        ';
    }

    // Cierra la estructura del componente de paginación
    $tabla .= '</nav>';

    // Retorna el HTML completo del componente de paginación
    return $tabla;
}
