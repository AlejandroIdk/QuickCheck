<?php
    $modulo_buscador = limpiar_cadena($_POST['modulo_buscador']); // Limpia y obtiene el módulo de búsqueda enviado por POST

    $modulos = ["roles", "usuario", "clases", "usuario_clase"]; // Lista de módulos válidos

    if (in_array($modulo_buscador, $modulos)) {
        // Si el módulo de búsqueda está dentro de los módulos válidos

        $modulos_url = [
            "roles" => "rol_search",
            "usuario" => "user_search",
            "clases" => "class_search",
            "usuario_clase" => "userClass_search"
        ];

        $modulos_url = $modulos_url[$modulo_buscador]; // URL correspondiente al módulo de búsqueda

        $modulo_buscador = "busqueda_" . $modulo_buscador; // Nombre de la sesión para almacenar el término de búsqueda

        if (isset($_POST['txt_buscador'])) {
            // Si se envió un término de búsqueda

            $txt = limpiar_cadena($_POST['txt_buscador']); // Limpia y obtiene el término de búsqueda

            if ($txt == "") {
                // Si el término de búsqueda está vacío, muestra un mensaje de error
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        Introduce el término de búsqueda
                    </div>
                ';
            } else {
                if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}", $txt)) {
                    // Si el término de búsqueda no coincide con el formato solicitado, muestra un mensaje de error
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrió un error inesperado!</strong><br>
                            El término de búsqueda no coincide con el formato solicitado
                        </div>
                    ';
                } else {
                    // Almacena el término de búsqueda en la sesión correspondiente y redirige a la página de búsqueda
                    $_SESSION[$modulo_buscador] = $txt;
                    header("Location: index.php?vista=$modulos_url", true, 303);
                    exit();
                }
            }
        }

        // Elimina el término de búsqueda de la sesión si se solicitó
        if (isset($_POST['eliminar_buscador'])) {
            unset($_SESSION[$modulo_buscador]);
            header("Location: index.php?vista=$modulos_url", true, 303);
            exit();
        }

    } else {
        // Si el módulo de búsqueda no es válido, muestra un mensaje de error
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No podemos procesar la petición
            </div>
        ';
    }
?>
