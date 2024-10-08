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
    <div class="container-fluid">
        <h1 class="display-4">Usuarios</h1>
        <h2 class="lead">Nuevo usuario</h2>
    </div>
    <div class="container pb-6 pt-5">

        <?php
        require_once "./php/main.php";
        ?>

        <div class="form-rest"></div>
        <form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rol_code">Rol:</label><br>
                        <div class="select">
                            <select class="form-control" name="rol_code">
                                <option value="" selected>Seleccione una opción</option>
                                <?php
                                $usuarios = conexion()->query("SELECT * FROM roles");
                                if ($usuarios->rowCount() > 0) {
                                    $usuarios = $usuarios->fetchAll();
                                    foreach ($usuarios as $usuario) {
                                        echo '<option value="' . $usuario['rol_code'] . '">' . $usuario['rol_nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}" minlength="3" maxlength="40">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_apellido">Apellido:</label>
                        <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}" minlength="3" maxlength="40">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_identificacion">Identificación:</label>
                        <input type="text" class="form-control" id="usuario_identificacion" name="usuario_identificacion" pattern="^[0-9]{10}$" minlength="10" maxlength="10" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_email">Email:</label>
                        <input type="email" class="form-control" id="usuario_email" name="usuario_email" maxlength="70">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_clave_1">Clave:</label>
                        <input type="password" class="form-control" id="usuario_clave_1" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_clave_2">Confirmar Clave:</label>
                        <input type="password" class="form-control" id="usuario_clave_2" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg mt-5">Registrar Usuario</button>
            </div>
        </form>
    </div>