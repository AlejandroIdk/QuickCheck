<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_new">Crear Clase</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_list">Lista de Clases</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_search">Buscar Usuario</a></li>
            </ol>
        </nav>
    </div>

    <?php
    include "./inc/btn_back.php";
    ?>
    <div class="container is-fluid mb-6">
        <h1 class="title">Clases</h1>
        <h2 class="subtitle">Lista de Clases</h2>
    </div>

    <div class="container pb-6 pt-6">
        <?php
        require_once "./php/main.php";

        if (isset($_GET['userclass_id_del'])) {
            require_once "./php/usuario_clase_eliminar.php";
        }

        if (!isset($_GET['page'])) {
            $pagina = 1;
        } else {
            $pagina = (int) $_GET['page'];
            if ($pagina <= 1) {
                $pagina = 1;
            }
        }

        $clase_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina = limpiar_cadena($pagina);
        $url = "index.php?vista=user_class_list&page=";
        $registros = 15;
        $busqueda = "";

        require_once "./php/usuario_clase_lista.php";
        ?>
    </div>