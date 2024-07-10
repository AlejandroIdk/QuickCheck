<?php
require "./inc/session_start.php";

$vista = isset($_GET['vista']) && !empty($_GET['vista']) ? $_GET['vista'] : 'login';

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {

    switch ($_SESSION['rol_code']) {
        case 1:
            // Admin role
            include "./inc/navbar.php";
            include "./vistas/$vista.php";
            include "./inc/script.php";
            break;
        case 2:
            // User role
            include "./inc/navbarStudent.php";
            include "./vistasUser/$vista.php";
            break;
        default:
            // Rol no válido, cerrar sesión
            include "./vistas/logout.php";
            exit();
    }
} else {

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