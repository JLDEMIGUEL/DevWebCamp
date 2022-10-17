<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>

    <?php 
        require_once __DIR__ . '\..\templates\alertas.php'
    ?>

    <form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label class="formulario__label">Nombre</label>
            <input type="nombre" class="formulario__input" value="<?php echo $usuario->nombre?>" placeholder="Tu nombre" id="nombre" name="nombre">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label">Apellido</label>
            <input type="apellido" class="formulario__input" value="<?php echo $usuario->apellido?>" placeholder="Tu apellido" id="apellido" name="apellido">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label">Email</label>
            <input type="email" class="formulario__input" value="<?php echo $usuario->email?>" placeholder="Tu email" id="email" name="email">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label">Password</label>
            <input type="password" class="formulario__input" placeholder="Tu password" id="password" name="password">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label">Repite password</label>
            <input type="password" class="formulario__input" placeholder="Tu password2" id="password2" name="password2">
        </div>

        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>


    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia sesion</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>