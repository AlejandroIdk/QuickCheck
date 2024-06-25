<?php
    // Almacenando datos
    $email = limpiar_cadena($_POST['login_email']);
    $clave = limpiar_cadena($_POST['login_clave']);

    // Verificando campos obligatorios
    if ($email == "" || $clave == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    // Verificando integridad de los datos
    // Verificación de formato de email y clave
    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $email)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El email no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La clave no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    // Verificación en la base de datos
    $check_user = conexion();
    $check_user = $check_user->query("SELECT * FROM usuario WHERE usuario_email='$email'");
    if ($check_user->rowCount() == 1) { // Si se encontró un usuario con el email proporcionado
        $check_user = $check_user->fetch();

        // Verificar si la clave ingresada coincide con la clave almacenada usando password_verify
        if ($check_user['usuario_email'] == $email && password_verify($clave, $check_user['usuario_clave'])) {
            // Iniciar sesión y almacenar datos en $_SESSION
            $_SESSION['id'] = $check_user['usuario_identificacion'];
            $_SESSION['nombre'] = $check_user['usuario_nombre'];
            $_SESSION['usuario'] = $check_user['usuario_email'];

            // Redireccionar al usuario a la página de inicio después del inicio de sesión
            if (headers_sent()) {
                echo "<script> window.location.href='index.php?vista=home'; </script>";
            } else {
                header("Location: index.php?vista=home");
            }
            exit();
        } else { // Si la clave no coincide
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Usuario o clave incorrectos
                </div>
            ';
        }
    } else { // Si no se encontró ningún usuario con el email proporcionado
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
    }
    $check_user = null; // Liberar recursos al finalizar
?>
