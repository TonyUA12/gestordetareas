<div  class="container login">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>
    <div class="container-sm">
        <p class="page-description">Iniciar Sesión</p>
        <?php include_once __DIR__ .'/../templates/alertas.php';?>
        <form method="POST" action="/" class="form">
            <div class="field">
                <label for="email">Correo</label>
                <input 
                    name="email" 
                    id="email"
                    type="email" 
                    placeholder="Ejem. correo@correo.com"
                >
            </div>

            <div class="field">
                <label for="password">Contraseña</label>
                <input 
                    name="password" 
                    id="password"
                    type="password" 
                    placeholder="Contraseña"
                >
            </div>

            <input type="submit" class="boton" value="Ingresar">
        </form>

        <div class="options">
            <a href="/createuser">Crear Cuenta</a>
            <a href="/forgotpassword">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

</div>