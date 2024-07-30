<?php
include "../php/validacioon_codigo.php"
?>

<div class="main-container" style="background-image: url('../assets/img/a.jpg'); background-size: cover; background-position: center; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <form class="box login" action="" method="POST" autocomplete="off" style="background: rgba(255, 255, 255, 0.549); padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%;">
        <h5 class="title is-5 has-text-centered is-uppercase" style="text-align: center;">Recuperación de la cuenta</h5>

        <div class="field mt-5">
            <label class="label">Código de verificación</label>
            <div class="control">
                <input class="input form-control" type="text" id="codigo" name="codigo" required maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <!-- "this.value" Se refiere al elemento de HTML -->
                <!-- "REPLACE" Busca algo en especifico para ser remplazado -->
                <!-- "[^0-9]" Rango de caracteres que no esten en un rango de 0 - 9, selecciona cualquier caracter que nos sea numero -->
                <!-- "/g" Es una cadena global, para que se realice en toda la cadena -->
                <!-- el usuario escribe en el campo, cualquier carácter que no sea un número es eliminado inmediatamente,
                    permitiendo solo la entrada de dígitos numéricos -->
            </div>
        </div>

        <div class="field">
            <label class="label">Nueva Clave:</label>
            <div class="control">
                <input type="password" class="form-control" id="usuario_clave_1" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Confirmar Clave:</label>
            <div class="control">
                <input type="password" class="form-control" id="usuario_clave_2" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
            </div>
        </div>

        <p class="has-text-centered mb-4 mt-3" style="text-align: center;">
            <button type="button" class="button is-info is-rounded btn btn-danger" onclick="location.href='../index.php'">Cancelar</button>
            <button type="submit" class="button is-info is-rounded btn btn-primary">Confirmar Cambios</button>
        </p>
    </form>
</div>