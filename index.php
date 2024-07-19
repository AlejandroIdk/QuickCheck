<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include "./inc/head.php"; ?>
</head>
<body>
    <?php
        // Establecer la vista por defecto si no está definida
        $vista = isset($_GET['vista']) && !empty($_GET['vista']) ? $_GET['vista'] : 'login';

        // Verificar si la vista solicitada existe y no es "login" ni "404"
        if (is_file("./vistas/$vista.php") && $vista != 'login' && $vista != '404') {
            // Verificar si el usuario está autenticado
            if (!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
                include "./vistas/logout.php";
                exit();
            }

            // Incluir la barra de navegación según el rol del usuario
            if ($_SESSION['rol_code'] == 1) {
                // Administrador
                include "./inc/navbar.php";
            } elseif ($_SESSION['rol_code'] == 2) {
                // Estudiante
                include "./inc/navbarStudent.php";
            }

            // Incluir la vista solicitada
            include "./vistas/$vista.php";

            // Incluir scripts adicionales
            include "./inc/script.php";
        } else {
            // Mostrar la página de inicio de sesión si la vista es "login"
            if ($vista == 'login') {
                include "./vistas/login.php";
            } else {
                // Mostrar página de error 404 si la vista no existe
                include "./vistas/404.php";
            }
        }
    ?>
    <footer>
        <script src="./js/mayusculas.js"></script>
        <?php include "./inc/footer.php"; ?>

    </footer>
</body>
</html>