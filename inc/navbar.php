
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-brand" href="index.php?vista=home">
            <img src="./assets/img/logo.png" class="rounded-circle" width="65" height="28" alt="Logo">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Roles</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=rol_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=rol_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=rol_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Usuarios</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Clases</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=class_new" class="navbar-item">Nueva</a>
                    <a href="index.php?vista=class_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=class_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Alumno - Clases</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=user_class_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=user_class_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=user_class_category" class="navbar-item">Por categoría</a>
                    <a href="index.php?vista=user_class_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Asistencia</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=scanner_user" class="navbar-item">Scannear</a>
                    <a href="index.php?vista=attendance_manual" class="navbar-item">Asistencia manual</a>

                    <a href="index.php?vista=attendance_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=attendance_class_category" class="navbar-item">Por categoría</a>
                    <a href="index.php?vista=attendance_search" class="navbar-item">Buscar</a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <!-- Botón de Actualizar -->
                    <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Actualizar
                    </a>

                    <!-- Botón de Salir con SweetAlert -->
                    <a href="index.php?vista=logout" class="button is-link is-rounded" id="btn-logout">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Script para SweetAlert -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el enlace de "Salir"
    const logoutLink = document.getElementById('btn-logout');

    // Agregar un event listener para el clic
    logoutLink.addEventListener('click', function(event) {
        // Prevenir el comportamiento predeterminado del enlace
        event.preventDefault();

        // Mostrar el alert de SweetAlert
        Swal.fire({
            title: '¿Estás seguro que deseas salir?',
            text: '¡Hasta luego!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, redirigir al enlace de salida
                window.location.href = logoutLink.getAttribute('href');
            }
        });
    });
});
</script>