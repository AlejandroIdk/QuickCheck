<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=class_new">Crear Clase</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=class_list">Lista de Clases</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=class_search">Buscar Clase</a></li>
            </ol>
        </nav>
    </div>
    <?php
    include "./inc/btn_back.php";
    ?>
    <div class="container is-fluid">
        <h1 class="title">Clases</h1>
        <h2 class="subtitle">Buscar Clase</h2>
    </div>

    <div class="container pb-6 pt-6">
        <?php
        require_once "./php/main.php";

        if (isset($_POST['modulo_buscador'])) {
            require_once "./php/buscador.php";
        }

        if (!isset($_SESSION['busqueda_clases']) && empty($_SESSION['busqueda_clases'])) {
        ?>
            <div class="columns">
                <div class="column">
                    <form action="" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo_buscador" value="clases">
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
                        <input type="hidden" name="modulo_buscador" value="clases">
                        <input type="hidden" name="eliminar_buscador" value="clases">
                        <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_clases']; ?>”</strong></p>
                        <br>
                        <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
                    </form>
                </div>
            </div>

        <?php
            if (isset($_GET['clase_id_del'])) {
                require_once "./php/clase_eliminar.php";
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
            $url = "index.php?vista=category_search&page=";
            $registros = 15;
            $busqueda = $_SESSION['busqueda_clases'];

            require_once "./php/clase_lista.php";
        }
        ?>
    </div>