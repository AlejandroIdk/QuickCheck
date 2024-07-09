<?php
require_once "main.php";

$modulo_buscador = limpiar_cadena($_POST['modulo_buscador']);

$modulos = ["roles", "usuario", "clases", "usuario_clase", "asistencia"];

if (in_array($modulo_buscador, $modulos)) {
    
    $modulos_url = [
        "roles" => "rol_search",
        "usuario" => "user_search",
        "clases" => "class_search",
        "usuario_clase" => "user_class_search",
        "asistencia" => "attendance_search"
    ];

    $modulos_url = $modulos_url[$modulo_buscador];
    $modulo_buscador = "busqueda_" . $modulo_buscador;

    if (isset($_POST['txt_buscador'])) {
        $txt = limpiar_cadena($_POST['txt_buscador']);

        if ($txt == "") {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Introduce el término de búsqueda
                </div>
            ';
        } else {
            $_SESSION[$modulo_buscador] = $txt;
            header("Location: index.php?vista=$modulos_url", true, 303); 
            exit();  
        }
    }

    # Eliminar búsqueda #
    if (isset($_POST['eliminar_buscador'])) {
        unset($_SESSION[$modulo_buscador]);
        header("Location: index.php?vista=$modulos_url", true, 303); 
        exit();
    }

} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No podemos procesar la petición
        </div>
    ';
}
?>
