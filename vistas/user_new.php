
<body>
    <div class="container-fluid mb-5">
        <h1 class="display-4">Usuarios</h1>
        <h2 class="lead">Nuevo usuario</h2>
    </div>
    <div class="container pb-5 pt-5">
        <div class="form-rest mb-5 mt-5"></div>
        <form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rol_code">Rol Code:</label>
                        <input type="text" class="form-control" id="rol_code" name="rol_code" required pattern="{3,40}" maxlength="40">
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
                        <label for="usuario_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_identificacion">Identificación:</label>
                        <input type="text" class="form-control" id="usuario_identificacion" name="usuario_identificacion" required pattern="{3,40}" maxlength="10">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_clave_1">Clave:</label>
                        <input type="password" class="form-control" id="usuario_clave_1" name="usuario_clave_1" required pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_clave_2">Confirmar Clave:</label>
                        <input type="password" class="form-control" id="usuario_clave_2" name="usuario_clave_2" required pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg mt-5">Registrar Usuario</button>
            </div>
        </form>
    </div>
