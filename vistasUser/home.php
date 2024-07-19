<?php require_once "./php/main.php";
$conexion = conexion();
?>
<div class="container py-4">
    <h1 class="display-6 text-center">INICIO</h1>
    <h2 class="h5 text-center">¡Bienvenido <?php echo $_SESSION['nombre']; ?>!</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">

        <div class="col">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Usuarios Registrados</h5>
                    <p class="card-text">
                        <?php
                        $consulta = $conexion->query("SELECT COUNT(*) AS total_usuarios FROM usuario");
                        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                        echo "Total: " . $resultado['total_usuarios'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Roles Registrados</h5>
                    <p class="card-text">
                        <?php
                        $consulta = $conexion->query("SELECT COUNT(*) AS total_roles FROM roles");
                        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                        echo "Total: " . $resultado['total_roles'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Clases Registradas</h5>
                    <p class="card-text">
                        <?php
                        $consulta = $conexion->query("SELECT COUNT(*) AS total_clases FROM clases");
                        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                        echo "Total: " . $resultado['total_clases'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Asistencias Registradas</h5>
                    <p class="card-text">
                        <?php
                        $consulta = $conexion->query("SELECT COUNT(*) AS total_asistencia FROM Asistencia");
                        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                        echo "Total: " . $resultado['total_asistencia'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>