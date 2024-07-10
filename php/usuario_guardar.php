<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "main.php";

    $rol = limpiar_cadena($_POST['rol_code'] ?? '');
    $nombre = limpiar_cadena($_POST['usuario_nombre'] ?? '');
    $apellido = limpiar_cadena($_POST['usuario_apellido'] ?? '');

    $identificacion = limpiar_cadena($_POST['usuario_identificacion'] ?? '');
    $clave_1 = limpiar_cadena($_POST['usuario_clave_1'] ?? '');
    $clave_2 = limpiar_cadena($_POST['usuario_clave_2'] ?? '');
    $email = limpiar_cadena($_POST['usuario_email'] ?? '');

    if ($rol == "" || $nombre == ""  || $apellido == "" || $identificacion == "" || $clave_1 == "" || $clave_2 == "" || $email == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    if (!is_numeric($rol)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El ROL no coincide con el formato solicitado (debe ser numérico)
            </div>
        ';
        exit();
    }

    if (
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$/", $nombre) ||
        !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}$/", $apellido) ||
        !preg_match("/^[0-9]{3,40}$/", $identificacion) ||
        !preg_match("/^[a-zA-Z0-9$@.-]{7,100}$/", $clave_1) ||
        !preg_match("/^[a-zA-Z0-9$@.-]{7,100}$/", $clave_2) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Uno o más campos no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

    $check_email = conexion()->prepare("SELECT usuario_email FROM usuario WHERE usuario_email=:email");
    $check_email->execute([':email' => $email]);
    if ($check_email->rowCount() > 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }

    $check_identificacion = conexion()->prepare("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion=:identificacion");
    $check_identificacion->execute([':identificacion' => $identificacion]);
    if ($check_identificacion->rowCount() > 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La IDENTIFICACIÓN ingresada ya se encuentra registrada
            </div>
        ';
        exit();
    }

    if ($clave_1 !== $clave_2) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Las CLAVES que ha ingresado no coinciden
            </div>
        ';
        exit();
    }

    $clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]);

    $guardar_usuario = conexion()->prepare("INSERT INTO usuario(rol_code, usuario_nombre, usuario_apellido, usuario_identificacion, usuario_clave, usuario_email) VALUES(:rol, :nombre, :apellido, :identificacion, :clave, :email)");

    $marcadores = [
        ":rol" => $rol,
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":identificacion" => $identificacion,
        ":clave" => $clave,
        ":email" => $email
    ];

    $guardar_usuario->execute($marcadores);

    if ($guardar_usuario->rowCount() == 1) {
        echo '
            <div class="notification is-info is-light">
                <strong>¡USUARIO REGISTRADO!</strong><br>
                El usuario se registró con éxito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar el usuario, por favor intente nuevamente
            </div>
        ';
    }
} else {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se ha enviado el formulario correctamente
          </div>';
}
