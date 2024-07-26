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
    <div class="container is-fluid">
        <h1 class="title">Clases</h1>
        <h2 class="subtitle">Buscar clase</h2>
    </div>
    <div class="container pb-6 pt-6">
        <?php
        require_once "./php/main.php";
        if (isset($_POST['modulo_buscador'])) {
            require_once "./php/buscador.php";
        }
        if (!isset($_SESSION['busqueda_usuario_clase']) && empty($_SESSION['busqueda_usuario_clase'])) {
        ?>
            <div class="columns">
                <div class="column">
                    <form action="" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo_buscador" value="usuario_clase">
                        <div class="field is-grouped">
                            <p class="control is-expanded">
                                <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30">
                            </p>
                            <p class="control">
                                <button class="button is-info" type="submit">Buscar</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="columns">
                <div class="column">
                    <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo_buscador" value="usuario_clase">
                        <input type="hidden" name="eliminar_buscador" value="usuario_clase">
                        <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_usuario_clase']; ?>”</strong></p>
                        <br>
                        <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
                    </form>
                </div>
            </div>
        <?php
            if (isset($_GET['product_id_del'])) {
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
            $url = "index.php?vista=user_class_search&page=";
            $registros = 15;
            $busqueda = $_SESSION['busqueda_usuario_clase'];
            require_once "./php/usuario_clase_lista.php";
        }
        ?>
    </div>