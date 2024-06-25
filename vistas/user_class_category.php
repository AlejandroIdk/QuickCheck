<div class="container is-fluid mb-6">
    <h1 class="title">Categorías</h1>
    <h2 class="subtitle">Lista de clases por categoría</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";
    ?>
    <div class="columns">
        <div class="column is-one-third">
            <h2 class="title has-text-centered">Categorías</h2>
            <?php
                $clases=conexion();
                $clases=$clases->query("SELECT * FROM clases");
                if($clases->rowCount()>0){
                    $clases=$clases->fetchAll();
                    foreach($clases as $row){
                        echo '<a href="index.php?vista=user_class_category&category_id='.$row['clase_id'].'" class="button is-link is-inverted is-fullwidth">'.$row['clase_nombre'].'</a>';
                    }
                }else{
                    echo '<p class="has-text-centered" >No hay categorías registradas</p>';
                }
                $clases=null;
            ?>
        </div>
        <div class="column">
            <?php
                $clase_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

                /*== Verificando clases ==*/
                $check_clases=conexion();
                $check_clases=$check_clases->query("SELECT * FROM clases WHERE clase_id='$clase_id'");

                if($check_clases->rowCount()>0){

                    $check_clases=$check_clases->fetch();

                    echo '
                        <h2 class="title has-text-centered">'.$check_clases['clase_nombre'].'</h2>
                        <p class="has-text-centered pb-6" >'.$check_clases['clase_ubicacion'].'</p>
                    ';

                    require_once "./php/main.php";

                    # Eliminar producto #
                    if(isset($_GET['product_id_del'])){
                        require_once "./php/usuario_clase_eliminar.php";
                    }

                    if(!isset($_GET['page'])){
                        $pagina=1;
                    }else{
                        $pagina=(int) $_GET['page'];
                        if($pagina<=1){
                            $pagina=1;
                        }
                    }

                    $pagina=limpiar_cadena($pagina);
                    $url="index.php?vista=user_class_category&category_id=$clase_id&page="; /* <== */
                    $registros=15;
                    $busqueda="";

                    # Paginador producto #
                    require_once "./php/usuario_clase_lista.php";

                }else{
                    echo '<h2 class="has-text-centered title" >Seleccione una categoría para empezar</h2>';
                }
                $check_clases=null;
            ?>
        </div>
    </div>
</div>