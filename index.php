<?php
require "./inc/session_start.php";

// Establecer la vista por defecto si no está definida
$vista = isset($_GET['vista']) && !empty($_GET['vista']) ? $_GET['vista'] : 'login';

// Verificar si el usuario está autenticado y tiene acceso a la vista solicitada
if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
    // Verificar el rol del usuario
    if ($_SESSION['rol_code'] == 1) {
        // Admin role
        include "./inc/navbar.php";
        include "./vistas/$vista.php";
        include "./inc/script.php";
    } elseif ($_SESSION['rol_code'] == 2) {
        // User role
        include "./inc/navbarStudent.php";
        include "./vistasUser/$vista.php";
    } else {
        // Rol no válido, cerrar sesión
        include "./vistas/logout.php";
        exit();
    }
} else {
    // Si no hay sesión activa, mostrar la página de inicio de sesión
    include "./vistas/login.php";
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "./inc/head.php"; ?>
</head>
<body>
    <footer>
        <?php include "./inc/footer.php"; ?>
    </footer>
</body>
</html>
