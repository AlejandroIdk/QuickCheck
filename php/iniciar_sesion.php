<?php

$email = limpiar_cadena($_POST['login_email']);
$clave = limpiar_cadena($_POST['login_clave']);

if (empty($email) || empty($clave)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El email no coincide con el formato solicitado
        </div>
    ';
    exit();
}

$check_user = conexion();

$stmt = $check_user->prepare("SELECT * FROM usuario WHERE usuario_email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {

    if (password_verify($clave, $user['usuario_clave'])) {

        $_SESSION['id'] = $user['usuario_identificacion'];
        $_SESSION['nombre'] = $user['usuario_nombre'];
        $_SESSION['usuario'] = $user['usuario_email'];
        $_SESSION['rol_code'] = $user['rol_code'];

        header("Location: index.php?vista=home");
        exit();
    } else {

        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
        exit();
    }
} else {

    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Usuario o clave incorrectos
        </div>
    ';
    exit();
}
