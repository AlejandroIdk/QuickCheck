<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php

$email = limpiar_cadena($_POST['login_email']);
$clave = limpiar_cadena($_POST['login_clave']);

if (empty($email) || empty($clave)) {
    mostrarAlerta('error', '¡Ocurrió un error inesperado!', 'No has llenado todos los campos que son obligatorios');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    mostrarAlerta('error', '¡Ocurrió un error inesperado!', 'El email no coincide con el formato solicitado');
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

        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Inicio de sesión exitoso!",
                    text: "Redirigiendo a la página principal...",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    didClose: () => {
                        window.location.href = "index.php?vista=home";
                    }
                });
              </script>';
        exit();
    } else {
        mostrarAlerta('error', '¡Ocurrió un error inesperado!', 'Correo o clave incorrectos');
        exit();
    }
} else {
    mostrarAlerta('error', '¡Ocurrió un error inesperado!', 'Correo o clave incorrectos');
    exit();
}

function mostrarAlerta($tipo, $titulo, $mensaje)
{
    echo '<script>
            Swal.fire({
                icon: "' . $tipo . '",
                title: "' . $titulo . '",
                text: "' . $mensaje . '",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                }
            });
          </script>';
}

?>