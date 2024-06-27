<?php
// Almacenando datos
$email = limpiar_cadena($_POST['login_email']);
$clave = limpiar_cadena($_POST['login_clave']);

// Verificando campos obligatorios
if (empty($email) || empty($clave)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

// Verificación de formato de email y clave
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El email no coincide con el formato solicitado
        </div>
    ';
    exit();
}

// Verificación en la base de datos con PDO y sentencias preparadas
$check_user = conexion(); // Debes definir tu función conexion() correctamente

$stmt = $check_user->prepare("SELECT * FROM usuario WHERE usuario_email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    // Verificar si la clave ingresada coincide con la clave almacenada
    if (password_verify($clave, $user['usuario_clave'])) {
        // Iniciar sesión y almacenar datos en $_SESSION
        $_SESSION['id'] = $user['usuario_identificacion'];
        $_SESSION['nombre'] = $user['usuario_nombre'];
        $_SESSION['usuario'] = $user['usuario_email'];
        $_SESSION['rol_code'] = $user['rol_code']; // Asegúrate de almacenar el rol adecuadamente

        // Redireccionar al usuario a la página de inicio después del inicio de sesión
        header("Location: index.php?vista=home");
        exit();
    } else {
        // Si la clave no coincide
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
        exit();
    }
} else {
    // Si no se encontró ningún usuario con el email proporcionado
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Usuario o clave incorrectos
        </div>
    ';
    exit();
}
?>
<!-- Código HTML y PHP restante -->
