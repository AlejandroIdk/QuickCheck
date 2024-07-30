<?php
include "../php/recuperar_contrasena.php"
?>

<div class="main-container" style="background-image: url('../assets/img/a.jpg'); background-size: cover; background-position: center; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <form class="box login" action="" method="POST" autocomplete="off" style="background: rgba(255, 255, 255, 0.549); padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%;">
        <h5 class="title is-5 has-text-centered is-uppercase" style="text-align: center;">Recuperación de la cuenta</h5>

        <div class="field mt-5">
            <label class="label">Correo electrónico</label>
            <div class="control">
                <input class="input form-control" type="text" name="correo" required>
            </div>
        </div>

        <p class="has-text-centered mb-4 mt-3" style="text-align: center;">
            <button type="submit" class="button is-info is-rounded btn btn-primary">Enviar código de recuperación</button>
        </p>
    </form>
</div>