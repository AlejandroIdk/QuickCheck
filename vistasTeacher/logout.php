<?php
session_destroy(); // Destruye todas las variables de sesión

// Verifica si los encabezados HTTP ya se han enviado
if (headers_sent()) {
    // Si los encabezados ya se han enviado, usa JavaScript para redirigir
    echo "<script> window.location.href='index.php?vista=login'; </script>";
} else {
    // De lo contrario, usa PHP para redirigir
    header("Location: index.php?vista=login");
}
