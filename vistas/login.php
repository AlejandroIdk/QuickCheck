<div class="main-container" style="background-image: url('assets/img/a.jpg'); background-size: cover; background-position: center; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <form class="box login" action="" method="POST" autocomplete="off" style="background: rgba(255, 255, 255, 0.549); padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <h5 class="title is-5 has-text-centered is-uppercase">Bienvenido</h5>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="text" name="login_email">
            </div>
        </div>

        <div class="field">
            <label class="label">Contraseña</label>
            <div class="control">
                <input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
            </div>
        </div>

        <p class="has-text-centered mb-4 mt-3">
            <button type="submit" class="button is-info is-rounded">Iniciar sesión</button>
        </p>
        <p class="has-text-centered mb-4 mt-3">
            <a href="./vistas/recovery.php">¿Has olvidado tu contraseña?</a>

        </p>

        <?php
        if (isset($_POST['login_email']) && isset($_POST['login_clave'])) {
            require_once "./php/main.php";
            require_once "./php/iniciar_sesion.php";
        }
        ?>
    </form>
</div>