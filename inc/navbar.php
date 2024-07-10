
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
                    <a href="index.php?vista=attendance_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=attendance_class_category" class="navbar-item">Por categoría</a>
                    <a href="index.php?vista=attendance_search" class="navbar-item">Buscar</a>

                </div>
            </div>

            <!-- PARA QUE FUNCIONE EL BUSCADOR DEBO ELIMINAR EL SEARCH DE ASISTENCIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA -->
            
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Mi cuenta
                    </a>

                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
