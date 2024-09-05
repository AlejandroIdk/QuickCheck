<?php
// Destruye todas las variables de sesión
session_destroy();

// Verifica si los encabezados HTTP ya se han enviado
if (headers_sent()) {
    // usa JavaScript para redirigir
    echo "<script> window.location.href='index.php?vista=login'; </script>";
} else {
    header("Location: index.php?vista=login");
}
