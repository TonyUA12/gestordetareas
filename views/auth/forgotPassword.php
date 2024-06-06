<div  class="container forgotPass">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>
    <div class="container-sm">
        <p class="page-description">Recuperar Contraseña</p>
        <?php include_once __DIR__ .'/../templates/alertas.php';?>
        <form method="POST" action="/forgotpassword" class="form">
            <div class="field">
                <label for="email">Correo</label>
                <input 
                    name="email" 
                    id="email"
                    type="email" 
                    placeholder="Ejem. correo@correo.com"
                >
            </div>

            <input type="submit" class="boton" value="Enviar Código">
        </form>

        <div class="options">
            <a href="/createuser">Crear Cuenta</a>
            <a href="/">Log In</a>
        </div>
    </div>

</div>