<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=user_new">Crear Usuario</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_list">Lista de Usuarios</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_search">Buscar Usuario</a></li>
            </ol>
        </nav>
    </div>
    <?php
    include "./inc/btn_back.php";
    ?>
    <div class="container is-fluid mb-6">
        <h1 class="title">Usuarios</h1>
        <h2 class="subtitle">Lista de usuarios</h2>
    </div>

    <div class="container pb-6 pt-6">
        <?php
        require_once "./php/main.php";

        if (isset($_GET['user_id_del'])) {
            require_once "./php/usuario_eliminar.php";
        }

        if (!isset($_GET['page'])) {
            $pagina = 1;
        } else {
            $pagina = (int) $_GET['page'];
            if ($pagina <= 1) {
                $pagina = 1;
            }
        }

        $pagina = limpiar_cadena($pagina);
        $url = "index.php?vista=user_list&page=";
        $registros = 15;
        $busqueda = "";

        require_once "./php/usuario_lista.php";
        ?>
    </div>