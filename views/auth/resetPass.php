<div  class="container forgotPass">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>
    <div class="container-sm">
        <p class="page-description">Nueva Contraseña</p>
        <?php include_once __DIR__ .'/../templates/alertas.php';?>
        <?php if($show) { ?>
        <form method="POST" class="form">
            <div class="field">
                <label for="password">Contraseña</label>
                <input 
                    name="password" 
                    id="password"
                    type="password" 
                    placeholder="Contraseña"
                >
            </div>

            <input type="submit" class="boton" value="Actualizar Contraseña">
        </form>
        <?php } ?>

        <div class="options">
            <a href="/createuser">Crear Cuenta</a>
            <a href="/">Log In</a>
        </div>
    </div>

</div>